<!-- app/View/Users/addCoordinador.ctp -->
<div class="users form">

    <?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Crear coordinador'); ?></legend>
        <?php echo $this->Form->input('username', array('label' => 'Nombre usuario', 'maxLength' => 255, 'title' => 'Nombre usuario'));
        echo $this->Form->input('name', array('label' => 'Name', 'maxLength' => 255, 'title' => 'Name'));
        echo $this->Form->input('surname', array('label' => 'Surname', 'maxLength' => 255, 'title' => 'Surname'));
        echo $this->Form->input('email', array('label' => 'Email', 'maxLength' => 255, 'title' => 'Email'));
        echo $this->Form->input('role', array(
            'options' => array('Coordinador' => 'Coordinador')
        ));
        echo $this->Form->input('password', array('label' => 'Contraseña', 'maxLength' => 255, 'title' => 'Contraseña'));
        echo $this->Form->input('password_confirm', array('label' => 'Confirmar contraseña', 'maxLength' => 255, 'title' => 'Confirmar contraseña', 'type'=>'password'));

        echo $this->Form->submit('Añadir coordinador', array('class' => 'form-submit',  'title' => 'Click para añadir') );
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>
<?php
if($this->Session->check('Auth.User')){
    echo $this->Html->link( "Volver a página principal",   array('action'=>'index') );
    echo "<br>";
    echo $this->Html->link( "Logout",   array('action'=>'logout') );
}else{
    echo $this->Html->link( "Volver a login",   array('action'=>'login') );
}
?>