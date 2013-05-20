<?php
echo $this->form->create('User', array('action' => 'login'));
echo $this->form->input('email_address',array('between'=>'<br>','class'=>'text'));
echo $this->form->input('password',array('between'=>'<br>','class'=>'text'));
echo $this->form->end('Sign In');
?>