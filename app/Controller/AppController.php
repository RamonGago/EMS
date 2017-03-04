<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $helpers = array(
        'Html',
        'Form'
    );

    // authorization for login and logut redirect
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'users', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => 'Debes estar logueado para continuar',
            'loginError' => 'Nombre de usuario o contraseña incorrectos',
            'authorize' => array('Controller')
        ));

    // only allow the login controllers only
    public function beforeFilter() {
        $this->Auth->allow('login');
        $this->set('current_user', $this->Auth->user());
        //var_dump($this->Auth->user());
    }

    public function isAuthorized($user) {
        // Admin puede acceder a todo
        // Si no es así entonces se trata de un usuario común y lo redirigimos a otra página.
        // En este caso a la acción usuario del controller users
        if (isset($user['role']) && $user['role'] === 'Admin_ORI' && $this->action='index') {
            return true;
        }
        elseif ($user['status'] == 1){
            $this->Session->Flash->success('Bienvenido, '. $this->Auth->user('username'));
            $this->redirect('Alumno');
            return true;
        }
        //Por defecto se deniega el acceso
        return false;
    }



}
