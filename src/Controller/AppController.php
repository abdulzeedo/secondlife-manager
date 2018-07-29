<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Date;
use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use \FrontendBridge\Lib\FrontendBridgeTrait;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    public $helpers = [
        'CkTools.CkTools',
        'FrontendBridge' => ['className' => 'FrontendBridge.FrontendBridge'],
        'Form' => [
            'className' => 'Bootstrap.Form'
        ],
        'Html' => [
            'className' => 'Bootstrap.Html'
        ],

        'Modal' => [
            'className' => 'Bootstrap.Modal'
        ],
        'Navbar' => [
            'className' => 'Bootstrap.Navbar'
        ],
        'Panel' => [
            'className' => 'Bootstrap.Panel'
        ]
    ];
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('FrontendBridge.FrontendBridge');
        Time::setDefaultLocale('it-IT'); // For any mutable DateTime
        FrozenTime::setDefaultLocale('it-IT'); // For any immutable DateTime
        Date::setDefaultLocale('it-IT'); // For any mutable Date
        FrozenDate::setDefaultLocale('it-IT'); // For any immutable Date


        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');


        $this->loadComponent('Auth', [
            // Added this line
            'authorize'=> 'Controller',
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer(),
            'loginRedirect' => $this->referer(),
            'logoutRedirect' => $this->referer()
        ]);



        // Allow the display action so our pages controller
        // continues to work. Also enable the read only actions.
//        $this->Auth->allow([]);
    }


    public function beforeRender(Event $event) {
        if ($this->Auth)
            $this->set('user', $this->Auth->user());

//        Configure::write('TimeZone', 'Europe/Rome');


    }
    public function isAuthorized($user)
    {
        // By default deny access.
        return true;
    }
}
