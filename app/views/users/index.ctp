<div class="pagination">
<?php echo $this->Paginator->numbers(array('separator'=>' ')); ?> 
<?php echo $this->Paginator->prev('<- Previous', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->next('Next ->', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->counter(); ?> 
</div>
<table>
  <tr>
    <th>Username</th>
    <th>First Name</th>
    <th>Last Name</th>
    <?php if($is_admin): ?>
      <th>Email</th>
    <?php endif; ?>
    <th>Actions</th>
  </tr>
<?php foreach($users as $user): ?>  
  <tr>
    <td><?php echo ucfirst($user['User']['username']); ?></td>
    <td><?php echo $user['User']['firstname']; ?></td>
    <td><?php echo $user['User']['lastname']; ?></td>
    <?php if($is_admin): ?>
      <td><?php echo $user['User']['email']; ?></td>
    <?php endif; ?>
    <td>
      <?php echo $this->Html->link('View', array('action'=>'view', $user['User']['id'])); ?>
      <?php if($is_admin): ?>
         | <?php echo $this->Html->link('delete', array('action'=>'delete', $user['User']['id'])); ?>
      <?php endif; ?>
    </td>
  </tr>  
<?php endforeach; ?>
</table>
<div class="pagination">
<?php echo $this->Paginator->numbers(array('separator'=>' ')); ?> 
<?php echo $this->Paginator->prev('<- Previous', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->next('Next ->', NULL, NULL, array('class'=>'disabled')); ?> 
<?php echo $this->Paginator->counter(); ?>
</div>