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
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
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
    /**
     * components
     * 
     * Array of components to load for every controller in the application
     * 
     * @var $components array
     * @access public
     */
    public $components = array('Auth');
    /**
     * beforeFilter
     * 
     * ��� ������� �������������� ����� ����� ��������� �����������
     * 
     * @access public 
     */
    public function beforeFilter(){
        //������������� ���� ��� ����������� � ���������� Auth ������ ���, ��� ���� ��-���������
        $this->Auth->fields = array('username'=>'email_address','password'=>'password');
        // ������������� �������� ��������� ��� ����������� �� ���� �������
        $this->Auth->allow('display');//� ��������� ���������, ��� �� ����������� �������� /pages/* ������ ����� ������ ������ (� �������, ��� ����������� �������)
        //��������, �� ������� ����� ���������� ������������ ����� ������ �� �������
        $this->Auth->logoutRedirect = '/users/index';
        //��������, �� ������� ����� ���������� ������������ ����� ����� � �������
        $this->Auth->loginRedirect = '/users/index';
        //�������� ��������� Auth ��� ������ �������� isAuthorized
        $this->Auth->authorize = 'controller';
        //�������� ������ ������ ��� ������������� ��� ������� �������
        $this->Auth->userScope = array('User.active = 1');
        //������� ��������� ����������� � �������� ����
        $this->set('Auth',$this->Auth->user());
    }
    /**
     * beforeRender
     * 
     * ��� ������� ���������� ����� ���, ��� �������� ��������������
     *
     * 
     * @access public 
     */
    public function beforeRender(){
        //���� ������������ �������������, �� �� ������������
        //������ ����������� ��� ���� ��������
        if($this->Auth->user()){
            $controllerList = Configure::listObjects('controller');
            $permittedControllers = array();
            foreach($controllerList as $controllerItem){
                if($controllerItem <> 'App'){
                    if($this->__permitted($controllerItem,'index')){
                        $permittedControllers[] = $controllerItem;
                    }
                }
            }
        }
        $this->set(compact('permittedControllers'));
    }
    /**
     * isAuthorized
     * 
     * ���������� ����������� Auth ��� �������� ������� � ��������
     * ��� �� � ����� ��������� ���� ��������
     * 
     * @return true if authorised/false if not authorized
     * @access public
     */
    private function isAuthorized(){
        return $this->__permitted($this->name,$this->action);
    }
    /**
     * __permitted
     * 
     * ��������������� �������, ������� ���������� �������� ���� ������������
     * ��������� � ����� $controllerName:$actionName
     * @return 
     * @param $controllerName Object
     * @param $actionName Object
     */
    public function __permitted($controllerName,$actionName){
        //��� ����������� ��������� � ������ ��������
        $controllerName = low($controllerName);
        $actionName = low($actionName);
        //���� � ������ ����� �� ���� �������������
        if(!$this->Session->check('Permissions')){
            //...�� ���������� ������ ��� ����������
            $permissions = array();
            //� ���� ���� ����� ����� �� �������
            $permissions[]='users:logout';
            //����������� ������ ������������, ����� �������� �����
            App::import('Model', 'User');
            $thisUser = new User;
            //�������� �������� ������������ � ��� ������
            $thisGroups = $thisUser->find(array('User.id'=>$this->Auth->user('id')));
            $thisGroups = $thisGroups['Group'];
            foreach($thisGroups as $thisGroup){
                $thisPermissions = $thisUser->Group->find(array('Group.id'=>$thisGroup['id']));
                $thisPermissions = $thisPermissions['Permission'];
                foreach($thisPermissions as $thisPermission){
                    $permissions[]=$thisPermission['name'];
                }
            }
            //���������� ����� � ������
            $this->Session->write('Permissions',$permissions);
        }else{
            //...������ ����� �������������, ��������� �� ������
            $permissions = $this->Session->read('Permissions');
        }
        //���� ����� ���� �������������� ��������
        foreach($permissions as $permission){
            if($permission == '*'){
                return true;//������� ����� ����������� :)
            }
            if($permission == $controllerName.':*'){
                return true;//����������� ��� �������� � ������ �����������
            }
            if($permission == $controllerName.':'.$actionName){
                return true;//������� ����������� ��������
            }
        }
        return false;
    }
}
