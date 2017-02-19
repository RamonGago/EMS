<!-- app/View/Users/usuario.ctp -->
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">EMS</a>
        </div>
        <!-- Top Menu Items -->
        <div>
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Joshua <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#"><i class="fa fa-fw fa-user"></i> Perfil</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li>
                    <a href="index.html"><i class="fa fa-fw fa-dashboard"></i> Inicio</a>
                </li>
                <li>
                    <a href="charts.html"><i class="fa fa-fw fa-globe"></i> Gestionar plaza Erasmus</a>
                </li>
                <li class="active">
                    <a href="tables.html"><i class="fa fa-fw fa-mail-forward"></i> Enviar documentación</a>
                </li>
                <li>
                    <a href="forms.html"><i class="fa fa-fw fa-file-text-o"></i> Contrato de estudios</a>
                </li>
                <li>
                    <a href="bootstrap-elements.html"><i class="fa fa-fw fa-plus-square"></i> Ampliación de estancia</a>
                </li>
                <li>
                    <a href="bootstrap-grid.html"><i class="fa fa-fw fa-remove"></i> Renuncia de plaza</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-power-off"></i> Perfil <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user-circle-o"></i> Ver perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-sign-out"></i>Cerrar sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listado de Usuarios del sistema
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
                                    <th><?php echo $this->Paginator->sort('username', 'Usuario');?>  </th>
                                    <th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
                                    <th><?php echo $this->Paginator->sort('created', 'Creado');?></th>
                                    <th><?php echo $this->Paginator->sort('modified','Modificado');?></th>
                                    <th><?php echo $this->Paginator->sort('role','Rol');?></th>
                                    <th><?php echo $this->Paginator->sort('status','Estado');?></th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="success">
                                    <?php $count=0; ?>
                                    <?php foreach($users as $user): ?>
                                    <?php $count ++;?>
                                    <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
                                    <?php endif; ?>
                                    <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
                                    <td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
                                    <td><?php echo $user['User']['email']; ?></td>
                                    <td><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
                                    <td><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
                                    <td><?php echo $user['User']['role']; ?></td>
                                    <td><?php echo $user['User']['status']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php unset($user); ?>
                                <tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

</body>

</html>

