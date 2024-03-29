<?php
/**
 * Created by PhpStorm.
 * User: tesina
 * Date: 05/08/2018
 * Time: 04:30
 */

namespace App\Controller\Component;


use Cake\Controller\Component;
use Cake\Controller\Controller;
use Cake\ORM\Table;

class ModalComponent extends Component
{

    public function initialize(array $config)
    {
        parent::initialize($config); // TODO: Change the autogenerated stub
    }

    /**
     * Used by all modals which do not process the information
     *
     * @param Cake\ORM\Table|null $table
     * @param $id
     * @param Cake\ORM\Model $entity
     */
    public function editOrAdd($table = null, $id, $entity) {
        /** @var Controller $controller */
        $controller = $this->_registry->getController();
        $controller->viewBuilder()->setLayout("bootstrap");
        $viewToExtend = "/Common/Form/form";
        if ($controller->request->is('ajax')) {
            $viewToExtend = "/Common/Modal/modal";
            $controller->viewBuilder()->setLayout(false);
        }

        if ($controller->request->is(['patch', 'post', 'put'])) {
            $entity = $table->patchEntity($entity, $controller->request->getData());
            if (!$table->save($entity)) {
                $controller->response = $controller->response->withStatus(400);
            }

        }
        $controller->set(compact('viewToExtend'));
    }

    public function editOrAddLayout($table = null, $id, $entity) {
        /** @var Controller $controller */
        $controller = $this->_registry->getController();
        $controller->viewBuilder()->setLayout("bootstrap");
        $viewToExtend = "/Common/Form/form";
        if ($controller->request->is('ajax')) {
            $viewToExtend = "/Common/Modal/modal";
            $controller->viewBuilder()->setLayout(false);
        }

        $controller->set(compact('viewToExtend'));
    }

}