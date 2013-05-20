<?php

/**
 * PostsController
 * 
 * Consist of index, view, add, edit, delete, search posts
 * 
 * @author Yura Savchuk
 */

class PostsController extends AppController {
    
    public $helpers = array( 'Html', 'Form', 'Session', 'Paginator' );
    
    public $components = array( 'Session' );
    
     public $paginate = array(
                'limit' => 2,
                'order' => array(
                    'Post.created' => 'desc'
                    )
                );
     
      public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index', 'view', 'search');
       }
     
    /** 
     * index method
     *  
     * @return void
     */
    public function index() {
        $this->Post->recursive = 0;
        $this->set('posts', $this->paginate('Post'));
        $this->set('title_for_layout', 'Список повідомлень');
    }
    
    /**
     * view method
     * 
     * @param int $id - id повідомлення
     * @return void 
     */
    public function view($id = NULL) {
        $post = $this->Post->findById($id);
        if (!$post) {
            $this->Session->setFlash('Повідомлення за заданим запитом не знайдено.');
            $this->redirect(array('action' => 'index'), NULL, TRUE);
        }
        $this->set('post', $post);
        $this->set('title_for_layout', 'Перегляд повідомлення');
    }

    /**
     * add method
     * 
     * @return void
     */
    public function add() {
         if ( $this->request->is('post') ) {
            $this->request->data['Post']['user_id'] = $this->Auth->User('id');
            $this->Post->create();
            if ( $this->Post->save($this->request->data) ) {
                $this->Session->setFlash('Повідомлення успішно збережено.');
            } else {
                $this->Session->setFlash('Повідомлення не додано.');
            }
            $this->redirect(array('action' => 'index'), NULL, TRUE);
        }
        $this->set('title_for_layout', 'Додати повідомлення');
    }
    
    /**
     * edit method
     * 
     * @param int $id - id повідомлення
     * @return void
     */
    public function edit($id = NULL) {
        $post = $this->Post->findById($id);
        if (!$post) {
            $this->Session->setFlash('Повідомлення за заданим запитом не знайдено.');
            $this->redirect(array('action' => 'index'), NULL, TRUE);
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash('Повідомлення успішно відредаговано.');
            } else {
                $this->Session->setFlash('Неможливо відредагувати повідомлення.');
            }
            $this->redirect(array('action' => 'index'), NULL, TRUE);
        }
        if (!$this->request->data) {
            $this->request->data = $post;
        }
        $this->set('title_for_layout', 'Редагувати повідомлення');
    }
    
    /**
     * delete method
     * 
     * @param int $id - id повідомлення
     * @return void
     */
    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash('Повідомлення з id='.$id.' видалено.');
            $this->redirect(array('action' => 'index'), NULL, TRUE);
        }
    }
    
    /**
     * search method
     * 
     * @return void
     */
    public function Search()
	{
		$condtitle=NULL;
		$this->set('posts', array());
		$condmessage=NULL;
		if ($this->request->is('post'))
		{
		$data=array();
		$this->set('error', NULL);
		$title=$this->data['title'];
		$message=$this->data['message'];
		if (!empty($title))
			$condtitle="Post.title LIKE '%$title%'";
		if (!empty($message))
			$condmessage="Post.message LIKE '%$messaget%'";
		$date=date("Y-m-d",mktime(NULL, NULL, NULL, $this->data['created']['month'],$this->data['created']['day'], $this->data['created']['year']));
		$conditions=array('OR'=>array('date(Post.created)'=>$date,$condtitle, $condmessage));
		if ($data = $this->Post->find('all', array('order'=>array('id'=>'DESC'), 'conditions'=>$conditions)))
        {
            $this->set('posts', $data);
        }
        else 
        {           
            $this->set('error', 'За даним запитом нічого не знайдено<br />');
        }
    	}
        $this->set('title_for_layout', 'Пошук повідомлень');
	}
    
    /**
     * isAuthorized method
     * 
     * @param string $user
     * @return boolean
     */
   /* public function isAuthorized($user) {
        // Всі зареєстовані користувачі можуть додавати повідомлення
        if ($this->action === 'add') {
            return true;
        }
        // Власники повідомлень можуть видаляти і редагувати їх
       if (in_array($this->action, array('edit','delete'))) {
            $postId = $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }
    */
}

?>