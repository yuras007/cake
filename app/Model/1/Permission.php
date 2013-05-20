<?php 
class Permission extends AppModel {
    public $name = 'Permission';
    public $hasAndBelongsToMany = array(
            'Group' => array('className' => 'Group',
                        'joinTable' => 'groups_permissions',
                        'foreignKey' => 'permission_id',
                        'associationForeignKey' => 'group_id',
                        'unique' => true
            )
    );
}
?>