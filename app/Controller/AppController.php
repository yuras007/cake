<?php
/**
 * The entry point to any controller.
 *
 * @author Yura Savchuk
 */
class AppController extends Controller {

    private $myAllowedActions = array();
	public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
    		'authorize' => array('Controller'),
            'authenticate' => array('Form' => array(
                    // Поле для авторизації в компоненті Auth замість того, що йде по-замовчуванню
                        'fields' => array('username' => 'email')))
        )
    );
    
    public function beforeFilter() {
		$this->Auth->authError = "Please login to view that page..";
    }
    
	public function isAuthorized($user) {
	    $myController = strtolower($this->name);
        $myAction = strtolower($this->action);
        if (!$this->myAllowedActions) {
            App::import('Model', 'User');
            $userObj = new User();
            $groupsObj = $userObj->find('first',array('conditions'=>array('User.id' => $user['id'])));
            $groupsObj = $groupsObj['Group'];
            
            foreach ($groupsObj as $groupObj) {
                $permissionsObj = $userObj->Group->find('first', array('conditions'=>array('Group.id' => $groupObj['id'])));
                $permissionsObj = $permissionsObj['Permission'];
                foreach ($permissionsObj as $permissionObj) {
                    $this->myAllowedActions[] = $permissionObj['name'];
                }
            }
        }
        
        if(!$this->myAllowedActions || !is_array($this->myAllowedActions)){
            return false;
        }
        foreach ($this->myAllowedActions as $myAllowedAction) {
            //Admins: Access to any controller and any action
        	if ($myAllowedAction == '*:*') {
                return true; 
            }
            //Allow all actions for any controller.
        	if ($myAllowedAction == $myController . ':*') {
                return true; //Controller with any action found
            }
            //Allow few actions.
            if ($myAllowedAction == $myController. ':' . $myAction) {
                return true; 
            }
        }
        return false;
	}

}

?>
