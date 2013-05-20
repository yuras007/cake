<?php
	class User extends AppModel {
     public $displayField = 'email_address';
     public $name = 'User';
     public $validate = array(
        'email_address' => array('email'),
        'password' => array('alphaNumeric'),
        'active' => array('numeric')
    );
    public $hasAndBelongsToMany = array(
            'Group' => array('className' => 'Group',
                        'joinTable' => 'groups_users',
                        'foreignKey' => 'user_id',
                        'associationForeignKey' => 'group_id',
                        'unique' => true
            )
    );
	
	public function beforeSave(){
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}
?>