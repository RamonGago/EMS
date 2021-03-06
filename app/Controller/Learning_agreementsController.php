<?php

class Learning_agreementsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Learning_agreement.id' => 'asc' )
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
            'order' => array('Learning_agreement.id' => 'asc' )
        );
        $learning_agreements = $this->paginate('Learning_agreement');
        $this->set(compact('learning_agreements'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Learning_agreement->create();
            if ($this->Learning_agreement->save($this->request->data)) {
                $this->Session->Flash->success('Nuevo contrato de estudios creado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear el contrato de estudios');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de contrato de estudios');
            $this->redirect(array('action'=>'index'));
        }

        $learning_agreement = $this->Learning_agreement->findById($id);
        if (!$learning_agreement) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Learning_agreement->id = $id;
            if ($this->Learning_agreement->save($this->request->data)) {
                $this->Session->Flash->success('Contrato de estudios modificado correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar el contrato de estudios');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $learning_agreement;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de contrato de estudios');
            $this->redirect(array('action'=>'index'));
        }

        $this->Learning_agreement->id = $id;
        if (!$this->Learning_agreement->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Learning_agreement->saveField('status', 0)) {
            $this->Session->Flash->success('Contrato de estudios eliminado correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar el contrato de estudios');
        $this->redirect(array('action' => 'index'));
    }

}

?>