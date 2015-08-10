<h1>Blog post</h1>
 <?php echo $this->Html->link(
                              'Add Post',
                              array('Controller'=>'posts','action'=>'add')
                              );
?>

<?php echo $this->Html->link(
                             $user['username'],
                             array('Controller'=>'users','action'=>'view',$user['id'])
                              );
?>

<table>
<tr>
 <th>Id</th>
        <th>Title</th>
        <th>User</th>
        <th>Comment</th>
        <th>Action</th>
        <th>Created</th>
</tr>

<?php foreach ($posts as $post): ?>
    <tr>
        <td><?php echo $post['Post']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($post['Post']['title'],
array('controller' => 'posts', 'action' => 'view', $post['Post']['id'])); ?>
        </td>
        <td>
        <?php echo $post['User']['username']; ?>
        </td>
        <td>
        <?php echo count($post['Comment']); ?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $post['Post']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
<?php echo $this->Html->link('Edit',array('action'=>'edit',$post['Post']['id'])); ?>
        </td>
        <td><?php echo $post['Post']['created']; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php unset($post); ?>
</table>