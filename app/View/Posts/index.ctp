<h1 align="center">Гостьова книга</h1>

<!-- Якщо існує id користувача, то виводимо ссилку "Вийти", інакше - ссилку "Ввійти" -->
<p align="right">
   <?php
   if (!$this->Session->read('Auth.User.id')) {
        echo $this->Html->link('Ввійти', array('controller' => 'Users', 'action' => 'login')); 
   } else {
        echo $this->Html->link('Вийти', array('controller' => 'Users', 'action' => 'logout')); 
   }
   ?>
</p>
<!-- Форма пошуку -->
<div>
    <fieldset>
        <legend>
            <?php echo __('Пошук'); ?>
        </legend>
       <?php 
            echo $this->form->create('Post', array('action' => 'search'));
            echo $this->form->input(NULL,array('label'=>'Назва: ', 'name'=>'title', 'type'=>'text'));
            echo $this->form->input(NULL,array('label'=>'Повідомлення: ', 'name'=>'message', 'type'=>'text'));
            echo $this->form->input('created',array('label'=>'Дата створення: ','type'=>'date', 'dateFormat'=>'YMD'));
            echo $this->form->end('Знайти');
       ?>
     </fieldset>
</div>

<br />
<p align="center">
    <?php if ($this->Session->read('Auth.User.id')) {
               echo $this->Html->link('Додати повідомлення', array('controller' => 'Posts',
                                      'action' => 'add')); } ?>
</p>
<br /> 
<h1 align="center">Список повідомлень<h1>
<table>
    <?php foreach($posts as $post): ?>
    <tr>
        <td><strong>Id:</strong> <?php echo $post['Post']['id']; ?></td>
        <td> <strong>Тема:</strong> <?php echo $post['Post']['title']; ?></td>
    </tr>
    
    <tr>
        <td> 
            <small>Дата створення: <?php echo $post['Post']['created']; ?> </small> 
        </td>
        <td> 
            <small>Дата редагування: <?php echo $post['Post']['modified']; ?> </small>
        </td>
    </tr>
    
    <tr>
        <td colspan="2"> 
            <strong>Опис:</strong> <?php echo $post['Post']['description']; ?> 
        </td>
    </tr>
    
    <tr>
        <td>
            <?php 
             if ($this->Session->read('Auth.User.id')) {
                echo $this->Html->link( 'Редагувати', array('controller' => 'Posts',
                                        'action' => 'edit', $post['Post']['id']) ); 
                echo "&nbsp;&nbsp;";
                echo $this->Form->postLink( 'Видалити', array('controller' => 'Posts',
                                            'action' => 'delete', $post['Post']['id']),
                                            array('confirm' => 'Ви впевнені?') ); 
             }
            ?>
        </td>
        <td> 
            <?php echo $this->Html->link( 'Переглянути', array('controller' => 'Posts', 
                                          'action' => 'view', $post['Post']['id']) ); ?> 
        </td>
    </tr>
<br />
<?php endforeach; ?>
<?php unset($post); ?>
</table>

<br />        
<p align="center">
<?php
    // Показуємо лінк на попередню сторінку
    echo $this->Paginator->prev('« Попередня   ', null, null, array('class' => 'disabled'));

    // Показуємо номери сторінок
    echo $this->Paginator->numbers();

    // Показуємо лінк на наступну сторінку
    echo $this->Paginator->next('   Наступна »', null, null, array('class' => 'disabled'));

    // Друкуємо к-сть сторінок і записів
    echo '<br />'.$this->Paginator->counter(array(
        'format' => 'Сторінка {:page} з {:pages}'.'<br />'.'(показується по {:current} записи з
                {:count} загальних)'
    ));
?>
</p>