<?php
class Post extends AppModel {
  
  public $hasMany = array(
        'Comment' => array(
            'className'     => 'Comment',
            'foreignKey'    => 'post_id',
        )
    );

  public $belongsTo = 'User';
  
  public $validate = array(
                          'title' => array(
                                           'rule' => 'notEmpty'
                                           ),
                          'body' => array(
                                           'rule' => 'notEmpty'
                                          )
                          );

  public function isOwnedBy($postId,$user){
    return $this->field('id',array('id' => $postId,'user_id' => $user)) !== false;
  }
  
}