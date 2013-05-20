<div class="posts form">
    <?php echo $this->Form->create('Post'); ?>
        <fieldset>
            <legend><?php echo __('Редагувати повідомлення'); ?></legend>
            <?php
                echo $this->Form->input('id', array('type' => 'hidden'));
                echo $this->Form->input('title', array('label' => 'Тема'));
                echo $this->Form->input('description', array(
                    'label' => 'Короткий опис', 'rows' => '3'));
                echo $this->Form->input('message', array(
                    'label' => 'Текст', 'rows' => '6'));
                echo $this->Form->input('tag', array('label' => 'Теги'));
            ?>
        </fieldset>
    <?php echo $this->Form->end(__('Редагувати')); ?>
</div>