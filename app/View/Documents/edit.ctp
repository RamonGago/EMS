<!-- app/View/Users/edit.ctp -->
<div class="users form">
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Editar usuario'); ?></legend>
        <?php 
		echo $this->Form->hidden('id', array('value' => $this->data['User']['id']));
		echo $this->Form->input('username', array('label' => 'Nombre usuario', 'readonly' => 'readonly', 'label' => 'Los usuarios no pueden cambiarse!'));
		echo $this->Form->input('email');
        echo $this->Form->input('password_update', array( 'label' => 'Nueva contraseña', 'maxLength' => 255, 'type'=>'password', 'required' => 0));
		echo $this->Form->input('password_confirm_update', array('label' => 'Repetir contraseña', 'maxLength' => 255, 'title' => 'Repite la contraseña', 'type'=>'password', 'required' => 0));
		
		echo $this->Form->input('role', array(
            'options' => array( 'usuario' => 'usuario', 'admin' => 'admin')
        ));
		
		echo $this->Form->submit('Editar usuario', array('class' => 'form-submit',  'title' => 'Click para modificar') ); 
?>
    </fieldset>
<?php echo $this->Form->end(); ?>
</div>
<?php 
echo $this->Html->link( "Volver a página principal",   array('action'=>'index') ); 
?>
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
?>