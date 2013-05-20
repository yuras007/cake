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
     * Это событие обрабатывается перед любым действием контроллера
     * 
     * @access public 
     */
    public function beforeFilter(){
        //Устанавливаем поля для авторизации в компоненте Auth вместо тех, что идут по-умолчанию
        $this->Auth->fields = array('username'=>'email_address','password'=>'password');
        // Устанавливаем действия доступные без авторизации по всей системе
        $this->Auth->allow('display');//В частности указываем, что на статические страницы /pages/* доступ будет открыт всегда (к примеру, для отображения главной)
        //Страница, на которую будут переходить пользователи после выхода из системы
        $this->Auth->logoutRedirect = '/users/index';
        //Страница, на которую будет переходить пользователь после входа в систему
        $this->Auth->loginRedirect = '/users/index';
        //Расширим компонент Auth при помощи действия isAuthorized
        $this->Auth->authorize = 'controller';
        //Разрешим доступ только тем пользователям чьи профили активны
        $this->Auth->userScope = array('User.active = 1');
        //Передаём компонент авторизации в страницы вида
        $this->set('Auth',$this->Auth->user());
    }
    /**
     * beforeRender
     * 
     * Это событие происходит перед тем, как страница отрисовывается
     *
     * 
     * @access public 
     */
    public function beforeRender(){
        //Если пользователь авторизирован, то мы обрабатываем
        //список разрешенных для него действий
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
     * Вызывается компонентом Auth для проверки доступа к элементу
     * тут мы и будем проводить нашу проверку
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
     * Вспомогательная функция, которая производит проверку прав пользователя
     * описанных в форме $controllerName:$actionName
     * @return 
     * @param $controllerName Object
     * @param $actionName Object
     */
    public function __permitted($controllerName,$actionName){
        //Имя контроллеря указываем в нижнем регистре
        $controllerName = low($controllerName);
        $actionName = low($actionName);
        //Если в сессии права не были закешированны
        if(!$this->Session->check('Permissions')){
            //...то подготовим массив для сохранения
            $permissions = array();
            //у всех есть право выйти из системы
            $permissions[]='users:logout';
            //Импортируем модель пользователя, чтобы получить права
            App::import('Model', 'User');
            $thisUser = new User;
            //Получаем текущего пользователя и его группу
            $thisGroups = $thisUser->find(array('User.id'=>$this->Auth->user('id')));
            $thisGroups = $thisGroups['Group'];
            foreach($thisGroups as $thisGroup){
                $thisPermissions = $thisUser->Group->find(array('Group.id'=>$thisGroup['id']));
                $thisPermissions = $thisPermissions['Permission'];
                foreach($thisPermissions as $thisPermission){
                    $permissions[]=$thisPermission['name'];
                }
            }
            //Записываем права в сессию
            $this->Session->write('Permissions',$permissions);
        }else{
            //...видимо права закешированны, загружаем из сессии
            $permissions = $this->Session->read('Permissions');
        }
        //Ищем среди прав соотвествующее текущему
        foreach($permissions as $permission){
            if($permission == '*'){
                return true;//Найдено право СуперАдмина :)
            }
            if($permission == $controllerName.':*'){
                return true;//Разрешаются все действия в данном контроллере
            }
            if($permission == $controllerName.':'.$actionName){
                return true;//Найдено определённое действие
            }
        }
        return false;
    }
}
