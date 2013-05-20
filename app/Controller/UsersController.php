<?php

/**
 * UsersController
 * 
 * Consist of index, view, add, edit, delete. ligin, logout
 * 
 * @author Yura Savchuk
 */

class UsersController extends AppController {

    /*
     * method beforeFilter
     * 
     * @return void
     */
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'logout', 'add');
    }
    
    /*
     * method index
     * 
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
        $this->set('title_for_layout', 'Список користувачів');
    }
    
    /*
     * method view
     * 
     * @return void
     */
    public function view($id){
		$this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Неправильний користувач'));
        }
        $this->set("user", $this->User->read(null, $id));
        $this->set('title_for_layout', 'Перегляд даних користувача');
    }

    /*
     * method add
     * 
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->data)) {
                $this->Session->setFlash(__('Користувача збережено', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('Користувач не може бути збережений. 
                                             Будь ласка, спробуйте знову.'));
            }
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
        $this->set('title_for_layout', 'Реєстрація користувача');
    }

    /*
     * method edit
     * 
     * @return void
     */
    public function edit($id = null) {
    	$this->User->id = $id;
    	if (!$this->User->exists()) {
            throw new NotFoundException(__('Неправильний користувач'));
        }
        if ($this->request->is('post')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Користувача збережено', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('Користувач не може бути збережений. 
                                             Будь ласка, спробуйте знову.', true));
            }
        } else {
        	$this->request->data = $this->User->read(null, $id);
        	unset($this->request->data['User']['password']);
        }
        $groups = $this->User->Group->find('list');
        $this->set(compact('groups'));
        $this->set('title_for_layout', 'Редагування користувача');
    }

    /*
     * method delete
     * 
     * @return void
     */
    public function delete($id = null) {
    	if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Неправильний користувач'));
        }
        if ($this->User->delete($id)) {
            $this->Session->setFlash(__('Користувача видалено', true));
            $this->redirect(array('action'=>'index'));
        }
        $this->Session->setFlash(__('Користувача не видалено'));
        $this->redirect(array('action' => 'index'));
    }
    
    /*
     * method login
     * 
     * @return void
     */
    public function login() {
    	if($this->request->is('post')){
	    	if($this->Auth->login()){
	    		$this->redirect(array("controller" => "posts", "action" => "index"));
	    	} else {
	    		if($this->request->is('post')){
		        	$this->Session->setFlash(__('Invalid username or password, try again'));
	    		}
	    	}
    	}
        $this->set('title_for_layout', 'Вхід');
    }

    /*
     * method logout
     * 
     * @return void
     */
    public function logout() {
        $this->Session->setFlash('До побачення');
        $this->redirect($this->Auth->logout());
    }    
           
}
?>