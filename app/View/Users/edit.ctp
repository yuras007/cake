<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Редагувати користувача'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('name');
		echo $this->Form->input('username');
		echo $this->Form->input('active');
		echo $this->Form->input('Group');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Редагувати'));?>
</div>
<div class="actions">
	<h3><?php echo __('Меню'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Видалити'), array('action' => 'delete', $this->Form->value('User.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Список користувачів'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('Список груп'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Створити групу'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
