<?php

class DocumentsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Document.id' => 'asc' )
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
            'order' => array('Document.id' => 'asc' )
        );
        $documents = $this->paginate('Document');
        $this->set(compact('documents'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Document->create();
            if ($this->Document->save($this->request->data)) {
                $this->Session->Flash->success('Nuevo documento creado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear el documento');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de documento');
            $this->redirect(array('action'=>'index'));
        }

        $document = $this->Document->findById($id);
        if (!$document) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Document->id = $id;
            if ($this->Document->save($this->request->data)) {
                $this->Session->Flash->success('Documento modificado correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar el documento');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $document;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de documento');
            $this->redirect(array('action'=>'index'));
        }

        $this->Document->id = $id;
        if (!$this->Document->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Document->saveField('status', 0)) {
            $this->Session->Flash->success('Documento eliminado correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar el documento');
        $this->redirect(array('action' => 'index'));
    }

}

?>