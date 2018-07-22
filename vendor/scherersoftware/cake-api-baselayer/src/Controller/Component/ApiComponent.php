<?php
namespace CakeApiBaselayer\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\Configure;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use Cake\Utility\Hash;
use CakeApiBaselayer\Lib\ApiReturnCode;

/**
 * Api component
 */
class ApiComponent extends Component
{

    /**
     * Used Components
     *
     * @var array
     */
    public $components = [
        'RequestHandler',
        'Auth'
    ];

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [
        'jsonEncodeOptions' => JSON_UNESCAPED_SLASHES,
        'header_name' => 'APITOKEN',
        'repository' => 'Users',
        'field' => 'api_token',
        'allow_parallel_sessions' => true,
    ];

    /**
     * Holds the Response object
     *
     * @var Response
     */
    protected $_response = null;

    /**
     * Maps return codes to HTTP status codes
     *
     * @var array
     */
    protected $_statusCodeMapping = [];


    /**
     * Table to be used
     *
     * @var array
     */
    protected $_table = null;

    /**
     * Flag if response contains validation errors
     *
     * @var bool
     */
    protected $_hasErrors = false;

    /**
     * Constructor hook method.
     *
     * Implement this method to avoid having to overwrite
     * the constructor and call parent.
     *
     * @param array $config The configuration settings provided to this component.
     * @return void
     */
    public function initialize(array $config)
    {
        $this->_table = TableRegistry::get($this->config('repository'));
        $this->_statusCodeMapping = ApiReturnCode::getStatusCodeMapping();
    }

    /**
     * Should be called in the controller's beforeFilter callback
     *
     * @return void
     */
    public function setup()
    {
        $this->RequestHandler->prefers('json');
        // Force a JSON response regardless of extension
        // $this->RequestHandler->renderAs($this->_registry->getController(), 'json');
    }

    /**
     * Returns the response object to modify
     *
     * @return Response
     */
    public function getResponse()
    {
        if ($this->_response) {
            return $this->_response;
        }
        return $this->_registry->getController()->response;
    }

    /**
     * Set the response object for manipulation by response()
     *
     * @param Response $response Response object to manipulate
     * @return void
     */
    public function setResponse(Response $response)
    {
        $this->_response = $response;
    }

    /**
     * Returns a standartized JSON response
     *
     * @param string $returnCode A string code more specific to the result
     * @param array $data Data for the 'data' key
     * @param int $httpStatusCode HTTP Status Code to send
     * @return Response
     */
    public function response($returnCode = ApiReturnCode::SUCCESS, array $data = [], $httpStatusCode = null)
    {
        if (!$httpStatusCode) {
            $httpStatusCode = $this->getHttpStatusForReturnCode($returnCode);
        }

        $response = $this->getResponse();
        $response->statusCode($httpStatusCode);

        $responseData = [
            'code' => $returnCode,
            'has_errors' => $this->hasErrors(),
            'data' => $data
        ];
        $response->type('json');
        $response->body(json_encode($responseData, $this->config('jsonEncodeOptions')));

        return $response;
    }

    /**
     * Returns the appropriate HTTP Status code for the given return code.
     *
     * @param string $returnCode Return Code
     * @return int
     */
    public function getHttpStatusForReturnCode($returnCode)
    {
        if (!isset($this->_statusCodeMapping[$returnCode])) {
            throw new \Exception("Return code {$returnCode} is not mapped to any HTTP Status Code.");
        }
        return $this->_statusCodeMapping[$returnCode];
    }

    /**
     * Obtain the status code mapping
     *
     * @return array
     */
    public function getStatusCodeMapping()
    {
        return $this->_statusCodeMapping;
    }

    /**
     * Map a return code to a status code
     *
     * @param string $returnCode Return Code
     * @param int $httpStatusCode The HTTP Status code to use for the given return code
     * @return void
     */
    public function mapStatusCode($returnCode, $httpStatusCode)
    {
        $this->_statusCodeMapping[$returnCode] = $httpStatusCode;
    }

    /**
     * Map return codes to HTTP Status codes
     *
     * @param array $codes Array with the return code as key and the HTTP Status code as value
     * @return void
     */
    public function mapStatusCodes(array $codes)
    {
        $this->_statusCodeMapping = Hash::merge($this->getStatusCodeMapping(), $codes);
    }

    /**
     * Handles authentication via the ApiToken header.
     *
     * @return void
     */
    public function apiTokenAuthentication()
    {
        if ($token = $this->request->header($this->config('header_name'))) {
            if (!$this->Auth->user() || $this->Auth->user($this->config('field')) !== $token) {
                $user = $this->_getEntityByToken($token);
                if ($user) {
                    $this->Auth->setUser($user->toArray());
                } else {
                    $this->Auth->logout();
                }
            }
        }
    }

    /**
     * Provides a table record for a token
     *
     * @param string $token token string
     * @return EntityInterface
     */
    protected function _getEntityByToken($token)
    {
        return $this->_table->find()
            ->where([
                $this->config('field') => $token
            ])
            ->first();
    }

    /**
     * Use the configured authentication adapters, and attempt to identify the user
     * by credentials contained in $request.
     *
     * @return array|bool User record data, or false, if the user could not be identified.
     */
    public function identify()
    {
        if ($this->Auth->user()) {
            $this->Auth->logout();
        }
        if ($user = $this->Auth->identify()) {
            if (empty($user[$this->config('field')]) || $this->config('allow_parallel_sessions') === false) {
                $userEntity = $this->_table->get($user['id']);
                $userEntity->api_token = $this->generateApiToken();
                $this->_table->save($userEntity);
                $user[$this->config('field')] = $userEntity->get($this->config('field'));
            }
            $this->Auth->setUser($user);
            return $user;
        }
        return false;
    }

    /**
     * clears the api token
     *
     * @return void
     */
    public function logout()
    {
        if ($this->Auth->user()) {
            $userEntity = $this->_table->get($this->Auth->user('id'));
            $userEntity->api_token = null;
            $this->_table->save($userEntity);
            $this->Auth->logout();
        }
    }

    /**
     * Generates a unique API token
     *
     * @return string
     */
    public function generateApiToken()
    {
        return bin2hex(openssl_random_pseudo_bytes(16));
    }

    /**
     * Gets and sets _hasErrors property.
     * If the parameter is null, it gets the actual value of the property.
     * If the parameter is not null, it sets the boolean representation of the given value into the
     * property and returns the newly set value.
     *
     * @param  bool  $errors sets the property
     * @return bool
     */
    public function hasErrors($errors = null)
    {
        if (!is_null($errors)) {
            $this->_hasErrors = (bool)$errors;
        }
        return $this->_hasErrors;
    }

    /**
     * Checks if a given entity or its children entities have errors.
     * If so, sets _hasErrors and returns true, if not, returns false.
     *
     * @param Entity $entity entity which has possibly errors in it
     * @return bool          has errors => true | has no errors => false
     */
    public function checkForErrors($entity) {
        if (is_callable([$entity, 'errors']) && !empty($entity->errors())) {
            return $this->hasErrors(true);
        }
        foreach ($entity->visibleProperties() as $propertyName) {
            $property = $entity->get($propertyName);
            if (is_callable([$property, 'errors']) && !empty($property->errors())) {
                return $this->hasErrors(true);
            }
        }
        return false;
    }
}
