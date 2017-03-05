<?php

class UsersController extends AppController {

    public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
        'order' => array('User.username' => 'asc' )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add');

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


    public function login() {

        $this->layout = 'custom';
        //if already logged-in, redirect
        if($this->Session->check('Auth.User')){
            $this->redirect(array('controller'=>'users','action'=>'alumno'));
        }

        // if we get the post information, try to authenticate
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Session->Flash->success('Bienvenido, '. $this->Auth->user('username'));
                $this->redirect($this->Auth->redirectUrl());
            } else {
                $this->Session->Flash->error('Nombre de usuario o contraseña incorrectos');
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

    //Acción para redirigir a los usuarios con rol admin_sec
    public function admin_sec() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
        $this->render('/Users/admin_sec');
    }

    //Acción para redirigir a los usuarios con rol coordinador
    public function coordinador() {
        $this->paginate = array(
            'limit' => 10,
            'order' => array('User.username' => 'asc' )
        );
        $users = $this->paginate('User');
        $this->set(compact('users'));
        $this->render('/Users/coordinador');
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
                $this->Session->Flash->success('Nuevo usuario creado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Hubo un error y no se pudo crear al usuario');
            }
        }
    }

    public function addAdmin() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->Flash->success('Nuevo usuario creado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Hubo un error y no se pudo crear al usuario');
            }
        }
    }

    public function addCoordinador() {
        if ($this->request->is('post')) {

            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->Flash->success('Nuevo usuario creado');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->Flash->error('Hubo un error y no se pudo crear al usuario');
            }
        }
    }

    public function edit($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de usuario');
            $this->redirect(array('action'=>'index'));
        }

        $user = $this->User->findById($id);
        if (!$user) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->User->id = $id;
            if ($this->User->save($this->request->data)) {
                $this->Session->Flash->success('Usuario modificado');
                $this->redirect(array('action' => 'edit', $id));
            }else{
                $this->Session->Flash->error('Hubo un error y no se pudo modificar al usuario');
            }
        }

        if (!$this->request->data) {
            $this->request->data = $user;
        }
    }

    public function delete($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de usuario');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->Flash->success('Usuario eliminado');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Hubo un error y no se pudo eliminar al usuario');
        $this->redirect(array('action' => 'index'));
    }

    public function activate($id = null) {

        if (!$id) {
            $this->Session->Flash->error('Es necesario proveer un ID de usuario');
            $this->redirect(array('action'=>'index'));
        }

        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->Flash->error('ID inválido');
            $this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->Flash->success('Usuario reactivado');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->Flash->error('Hubo un error y no se pudo reactivar al usuario');
        $this->redirect(array('action' => 'index'));
    }

}

?>