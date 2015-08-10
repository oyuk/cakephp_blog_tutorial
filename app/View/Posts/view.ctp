<h1><?php echo h($post['Post']['title']); ?></h1>
<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>
<p><?php echo h($post['Post']['body']); ?></p>

<h1>Comment</h1>
<?php
echo $this->Form->create('Comment', array('url' => array('controller' => 'comments', 'action' => 'add')));
echo $this->Form->input('body',array('rows'=> '3'));
echo $this->Form->hidden('post_id', array('value' => $post['Post']['id']));
echo $this->Form->end('Save Comment');
?>

<?php foreach( $post['Comment'] as $comment ): ?>
<?php echo $comment['user_id']; ?>
<?php if ($comment['user_id'] == $user_id) :
echo $this->Form->postLink(
                'Delete',
                array('controller' => 'comments','action' => 'delete', $comment['id']),
                array('confirm' => 'Are you sure?'));
endif ?>
<p><?php echo $comment['body']; ?></p>
<?php endforeach; ?>