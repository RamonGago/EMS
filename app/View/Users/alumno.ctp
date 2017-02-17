<!-- app/View/Users/usuario.ctp -->
<div class="users form">
	<h1 style="font-weight: bold; color: red; text-decoration: underline;"> Página de usuario común</h1>
	<h1>Usuarios:</h1>
	<table>
	    <thead>
			<tr>
				<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
				<th><?php echo $this->Paginator->sort('username', 'Usuario');?>  </th>
				<th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
				<th><?php echo $this->Paginator->sort('created', 'Creado');?></th>
				<th><?php echo $this->Paginator->sort('modified','Modificado');?></th>
				<th><?php echo $this->Paginator->sort('role','Rol');?></th>
				<th><?php echo $this->Paginator->sort('status','Estado');?></th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>						
			<?php $count=0; ?>
			<?php foreach($users as $user): ?>				
			<?php $count ++;?>
			<?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
			<?php endif; ?>
				<td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
				<td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
				<td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
				<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
				<td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['modified']); ?></td>
				<td style="text-align: center;"><?php echo $user['User']['role']; ?></td>
				<td style="text-align: center;"><?php echo $user['User']['status']; ?></td>
			</tr>
			<?php endforeach; ?>
			<?php unset($user); ?>
		</tbody>
	</table>
	<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	<?php echo $this->Paginator->numbers(array(   'class' => 'numbers'     ));?>
	<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
</div>				
<br/>
<?php 
echo $this->Html->link( "Logout",   array('action'=>'logout') ); ?>