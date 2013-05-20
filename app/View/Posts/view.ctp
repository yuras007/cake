<table>
    
    <tr>
        <td><strong>Id:</strong> <?php echo $post['Post']['id']; ?></td>
        <td> <strong>Тема:</strong> <?php echo h($post['Post']['title']); ?></td>
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
            <strong>Опис:</strong> <?php echo h($post['Post']['description']); ?> 
        </td>
    </tr>
    
    <tr>
        <td colspan="2"> 
            <?php echo h($post['Post']['message']); ?> 
        </td>
    </tr>
    
</table>