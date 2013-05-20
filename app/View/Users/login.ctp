<div class="users form">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User'); ?>
<fieldset>
    <legend>
        <?php echo __('Вхід'); ?>
    </legend>
    <?php
        echo $this->Form->input('email', array('label' => 'Пошта (email)'));
        echo $this->Form->input('password', array('label' => 'Пароль'));
    ?>
</fieldset>
    <?php echo $this->Form->end(__('Увійти')); ?>
</div>
