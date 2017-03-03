<?php

class Extension_resquestsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Extension_resquest.id' => 'asc' )
    );
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow();

        //Si el usuario tiene un rol de admin entonces le dejamos paso a todo.
        //Si no es así se trata de un usuario común y le permitimos solo la acción
        //logout y la correspondiente a usuario (página solo para ellos)
        if($this->Auth->user('role') === 'Admin_ORI') {
            $this->Auth->allow();
        } elseif ($this->Auth->user('role') === 'Admin_SEC') {
            $this->Auth->allow('logout', 'Admin_SEC');
        } elseif ($this->Auth->user('role') === 'Coodinador') {
            $this->Auth->allow('logout', 'Coordinador');
        } elseif ($this->Auth->user('role') === 'Alumno') {
            $this->Auth->allow('logout', 'Alumno');
        }
    }



    public function index() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('Extension_resquest.id' => 'asc' )
        );
        $extension_resquests = $this->paginate('Extension_resquest');
        $this->set(compact('extension_resquests'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Extension_resquest->create();
            if ($this->Extension_resquest->save($this->request->data)) {
                $this->Session->Flash->success('Ampliación de estancia creada correctamente');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear la ampliación de estancia');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de ampliación de estancia');
            $this->redirect(array('action'=>'index'));
        }

        $extension_resquest = $this->Extension_resquest->findById($id);
        if (!$extension_resquest) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Extension_resquest->id = $id;
            if ($this->Extension_resquest->save($this->request->data)) {
                $this->Session->Flash->success('Ampliación de estancia modificada correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar la ampliación de estancia');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $extension_resquest;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de ampliación de estancia');
            $this->redirect(array('action'=>'index'));
        }

        $this->Extension_resquest->id = $id;
        if (!$this->Extension_resquest->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Extension_resquest->saveField('status', 0)) {
            $this->Session->Flash->success('Ampliación de estancia eliminada correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar el contrato de estudios');
        $this->redirect(array('action' => 'index'));
    }

}

?>