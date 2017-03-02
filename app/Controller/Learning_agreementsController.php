<?php

class Learning_agreementsController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add');

        //Si el usuario tiene un rol de admin entonces le dejamos paso a todo.
        //Si no es así se trata de un usuario común y le permitimos solo la acción
        //logout y la correspondiente a usuario (página solo para ellos)
        if($this->Auth->user('role') === 'Admin_ORI') {
            $this->Auth->allow();
        } elseif ($this->Auth->user('role') === 'Alumno') {
            $this->Auth->allow('logout', 'Alumno');
        }
    }



    public function login() {

        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('action' => 'index'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->setFlash(__('Bienvenido, '. $this->Auth->user('username')));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->setFlash(__('Nombre de usuario o contraseña incorrectos'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
    }

    //Acción para redirigir a los usuarios con rol alumno
    public function alumno() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
        $this->render('/Users/alumno');
    }


    public function add() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Nuevo usuario creado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Hubo un error y no se pudo crear al usuario'));
            }
        }
    }

    public function addAdmin() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Nuevo usuario creado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Hubo un error y no se pudo crear al usuario'));
            }
        }
    }

    public function addCoordinador() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Nuevo usuario creado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Hubo un error y no se pudo crear al usuario'));
            }
        }
    }

    public function edit($id = null) {

        if (!$id) {
            $this->Session->setFlash('Es necesario proveer un ID de usuario');
            $this->redirect(array('action'=>'index'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            $this->Session->setFlash('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Usuario modificado'));
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->setFlash(__('Hubo un error y no se pudo modificar al usuario'));
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->setFlash('Es necesario proveer un ID de usuario');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('Usuario eliminado'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Hubo un error y no se pudo eliminar al usuario'));
        $this->redirect(array('action' => 'index'));
    }

    public function activate($id = null) {

        if (!$id) {
            $this->Session->setFlash('Es necesario proveer un ID de usuario');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('Usuario reactivado'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Hubo un error y no se pudo reactivar al usuario'));
        $this->redirect(array('action' => 'index'));
    }

}

?>