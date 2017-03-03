<!-- app/View/Users/add.ctp -->
<div class="users form">

<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Añadir usuario'); ?></legend>
        <?php echo $this->Form->input('username', array('label' => 'Nombre usuario', 'maxLength' => 255, 'title' => 'Nombre usuario'));
        echo $this->Form->input('name', array('label' => 'Nombre', 'maxLength' => 255, 'title' => 'Name'));
        echo $this->Form->input('surname', array('label' => 'Apellidos', 'maxLength' => 255, 'title' => 'Surname'));
        echo $this->Form->input('email', array('label' => 'Email', 'maxLength' => 255, 'title' => 'Email'));
        echo $this->Form->input('password', array('label' => 'Contraseña', 'maxLength' => 255, 'title' => 'Contraseña'));
		echo $this->Form->input('password_confirm', array('label' => 'Confirmar contraseña', 'maxLength' => 255, 'title' => 'Confirmar contraseña', 'type'=>'password'));
		
		echo $this->Form->submit('Añadir usuario', array('class' => 'form-submit',  'title' => 'Click para añadir') ); 
?>
    </fieldset>

    <!-- <form id="register-form" action="add" method="post" role="form" style="display: none;">
                                <h2>Registrarse</h2>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="Nombre de usuario">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="Correo electrónico">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="Contraseña" >
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" value="Confirmar contraseña">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registrarse">
                                        </div>
                                    </div>
                                </div>
                            </form>
    -->


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