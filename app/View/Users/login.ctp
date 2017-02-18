<!-- app/View/Users/login.ctp -->

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <fieldset>
                                <h2>Bienvenido a la plataforma EMS</h2>
                                <?php echo $this->Session->flash('auth'); ?>
                                <?php echo $this->Form->create('User'); ?>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('username',array(
                                        'class' => 'form-control',
                                        'div' => false, 'type' => 'text', 'id'=>'username', 'tabindex' => '1', 'label' => 'Nombre de usuario'));
                                    ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                    echo $this->Form->input('password',array(
                                        'class' => 'form-control',
                                        'div' => false, 'type' => 'password', 'id'=>'password', 'tabindex' => '2', 'label' => 'Contraseña'));
                                    ?>
                                </div>
                                <div class="col-xs-6 form-group pull-left checkbox">
                                    <input id="checkbox1" type="checkbox" name="remember">
                                    <label for="checkbox1">Recordarme</label>
                                </div>
                                <div class="col-xs-6 form-group pull-right">
                                    <?php
                                    echo $this->Form->submit('Entrar',array(
                                        'class' => 'btn-login',
                                        'div' => false, 'type' => 'submit', 'id'=>'login-submit', 'tabindex' => '4'));
                                    ?>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
