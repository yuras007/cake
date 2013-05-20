<?php
App::uses('AppModel', 'Model');
/**
 * GroupsPermission Model
 *
 * @property Group $Group
 * @property Permission $Permission
 */
class GroupsPermission extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Permission' => array(
			'className' => 'Permission',
			'foreignKey' => 'permission_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
