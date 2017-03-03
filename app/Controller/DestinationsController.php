<?php

class DestinationsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Destination.id' => 'asc' )
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
            'order' => array('Destination.id' => 'asc' )
        );
        $destinations = $this->paginate('Destination');
        $this->set(compact('destinations'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Destination->create();
            if ($this->Destination->save($this->request->data)) {
                $this->Session->Flash->success('El nuevo destino erasmus ha sido creado correctamente');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear el destino erasmus');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de destino erasmus');
            $this->redirect(array('action'=>'index'));
        }

        $destination = $this->Destination->findById($id);
        if (!destination) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Destination->id = $id;
            if ($this->Destination->save($this->request->data)) {
                $this->Session->Flash->success('El destino erasmus se ha modificado correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar el destino erasmus');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $destination;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de destino erasmus');
            $this->redirect(array('action'=>'index'));
        }

        $this->Destination->id = $id;
        if (!$this->Destination->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Destination->saveField('status', 0)) {
            $this->Session->Flash->success('El destino erasmus ha sido eliminado correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar el destino erasmus');
        $this->redirect(array('action' => 'index'));
    }

}

?>