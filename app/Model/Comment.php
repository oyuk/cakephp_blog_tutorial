<?php

class Comment extends AppModel {

  public $belongsTo = 'Post';
  
  public $validate = array(
                          'body' => array(
                                           'rule' => 'notEmpty'
                                          )
                          );

   public function isOwnedBy($commentId,$user){
    return $this->field('id',array('id' => $postId,'user_id' => $user)) !== false;
  }
  
}