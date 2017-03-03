<?php

class ResignationsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('Resignation.id' => 'asc' )
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
            'order' => array('Resignation.id' => 'asc' )
        );
        $resignations = $this->paginate('Resignation');
        $this->set(compact('resignations'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->Resignation->create();
            if ($this->Resignation->save($this->request->data)) {
                $this->Session->Flash->success('La renuncia de plaza se ha creada correctamente');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear la renuncia de plaza');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de contrato de estudios');
            $this->redirect(array('action'=>'index'));
        }

        $resignation = $this->Resignation->findById($id);
        if (!$resignation) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Resignation->id = $id;
            if ($this->Resignation->save($this->request->data)) {
                $this->Session->Flash->success('Renuncia de plaza modificado correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar la renuncia de plaza');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $resignation;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de renuncia de plaza');
            $this->redirect(array('action'=>'index'));
        }

        $this->Resignation->id = $id;
        if (!$this->Resignation->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->Resignation->saveField('status', 0)) {
            $this->Session->Flash->success('La renuncia de plaza se ha creada correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar la renuncia de plaza');
        $this->redirect(array('action' => 'index'));
    }

}

?>