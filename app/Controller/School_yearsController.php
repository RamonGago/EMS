<?php

class School_yearsController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('School_year.id' => 'asc' )
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
            'order' => array('School_year.id' => 'asc' )
        );
        $school_years = $this->paginate('School_year');
        $this->set(compact('school_years'));
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->School_year->create();
            if ($this->School_year->save($this->request->data)) {
                $this->Session->Flash->success('El nuevo año académico ha sido creado correctamente');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Ha habido un error, no se ha podido crear el año académico');
            }
        }
    }


    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID del año académico');
            $this->redirect(array('action'=>'index'));
        }

        $school_year = $this->School_year->findById($id);
        if (!$school_year) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->School_year->id = $id;
            if ($this->School_year->save($this->request->data)) {
                $this->Session->Flash->success('El año académico ha sido modificado correctamente');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Ha habido un error, no se ha podido modificar el año académico');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $school_year;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID del año académico');
            $this->redirect(array('action'=>'index'));
        }

        $this->School_year->id = $id;
        if (!$this->School_year->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->School_year->saveField('status', 0)) {
            $this->Session->Flash->success('Año académico eliminado correctamente');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Ha habido un error, no se ha podido eliminar el año académico');
        $this->redirect(array('action' => 'index'));
    }

}

?>