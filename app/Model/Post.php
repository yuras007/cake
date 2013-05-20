<?php

/**
 * Post Model
 * 
 */

class Post extends AppModel {
    
    public $displayField = 'title';
    
    public $validate = array( 
                            'title' => array('rule' => 'notEmpty', 
                                    'message' => 'Поле обов\'язкове для заповнення'),
                            'description' => array('rule' => 'notEmpty',
                                    'message' => 'Поле обов\'язкове для заповнення'),
                            'message' => array('rule' => 'notEmpty',
                                    'message' => 'Поле обов\'язкове для заповнення') );   
    /*
    public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	); */
    /*
    var $hasAndBelongsToMany = array('Tag' => 
                               array('className'    => 'Tag', 
                                     'joinTable'    => 'posts_tags', 
                                     'foreignKey'   => 'post_id', 
                                     'associationForeignKey'=> 'tag_id', 
                                     'conditions'   => '', 
                                     'order'        => '', 
                                     'limit'        => '', 
                                     'unique'       => true, 
                                     'finderQuery'  => '', 
                                     'deleteQuery'  => '', 
                               ) 
                               ); */
    
    /*
     * method isOwnedBy
     * 
     * @param string $post
     * @param string $user
     * 
     * @return array
     */
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post, 'user_id' => $user)) === $post;
    }

}
?>