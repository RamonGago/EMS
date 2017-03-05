<!-- app/View/Users/usuario.ctp -->
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


