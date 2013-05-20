<?php
class UsersController extends AppController {
public $components = array(
             'Session',);
    public $name = 'Users';
    public $scaffold;
    //function login(){}
	public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash(__('Неправильний логін або пароль, повторіть спробу'), 'default', array(), 'auth');
            }
        }
    }
    public function logout(){
        $this->Session->del('Permissions');
        $this->redirect($this->Auth->logout());
    }
}
?>