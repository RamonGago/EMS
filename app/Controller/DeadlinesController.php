<?php

class DeadlinesController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Deadline.id' => 'asc' )
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
            'order' => array('Deadline.id' => 'asc' )
        );
        $deadlines = $this->paginate('Deadline');
        $this->set(compact('deadlines'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Deadline->create();
            if ($this->Deadline->save($this->request->data)) {
                $this->Session->Flash->success('Nuevo plazo de entrega creado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear el plazo de entrega');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de plazo de entrega');
            $this->redirect(array('action'=>'index'));
        }

        $deadline = $this->Deadline->findById($id);
        if (!$deadline) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Deadline->id = $id;
            if ($this->Deadline->save($this->request->data)) {
                $this->Session->Flash->success('Plazo de entrega modificado correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar el plazo de entrega');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $deadline;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de plazo de entrega');
            $this->redirect(array('action'=>'index'));
        }

        $this->Deadline->id = $id;
        if (!$this->Deadline->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Deadline->saveField('status', 0)) {
            $this->Session->Flash->success('Plazo de entrega eliminado correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar el plazo de entrega');
        $this->redirect(array('action' => 'index'));
    }

}

?>