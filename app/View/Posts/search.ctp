<h1 align="center">Пошук</h1>

<p align="right">
     <?php echo $this->Html->link('На головну', array('controller' => 'Posts', 'action' => 'index')); ?>
</p>

<div align="left">
<br />
<?php if (empty($posts)) { ?>
        <p align="center">
            <font color=red>
                <?php if (!empty($error)) echo $error; ?>
            </font>
        </p>
<?php } else {?>
<table>
    <tr>        
        <th>Id</th>
        <th>Назва</th>
        <th>Опис</th>
        <th>Дата створення</th>
        <th>Дата редагування</th>
    </tr>
    
    <?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td><?php echo $post['Post']['title']; ?></td>
        <td><?php echo $post['Post']['description']; ?></td>
        <td><?php echo $post['Post']['created']; ?></td>
        <td><?php echo $post['Post']['modified']; ?></td>
    </tr>
    <?php endforeach; } ?>
</table>
</div>