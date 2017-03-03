<?php

class PlacesController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Place.id' => 'asc' )
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
            'order' => array('Place.id' => 'asc' )
        );
        $place = $this->paginate('Place');
        $this->set(compact('place'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Place->create();
            if ($this->Place->save($this->request->data)) {
                $this->Session->Flash->success('La nueva plaza ha sido creada correctamente');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear la plaza');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de plaza');
            $this->redirect(array('action'=>'index'));
        }

        $place = $this->Place->findById($id);
        if (!$place) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Place->id = $id;
            if ($this->Place->save($this->request->data)) {
                $this->Session->Flash->success('La plaza ha sido modificada correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar la plaza');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $place;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de plaza');
            $this->redirect(array('action'=>'index'));
        }

        $this->Place->id = $id;
        if (!$this->Place->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Place->saveField('status', 0)) {
            $this->Session->Flash->success('La plaza ha sido eliminada correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar la plaza');
        $this->redirect(array('action' => 'index'));
    }

}

?>