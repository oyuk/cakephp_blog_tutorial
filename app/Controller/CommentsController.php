<?php

class CommentsController extends AppController {
  public $helper = array('Html','Form','Session');
  public $components = array('Session');

  public function index(){
    $comments = $this->Comment->find('all');
    $this->set('comments',$comments);
  }

  public function add() {
    if ($this->request->is('post')) {
        $this->request->data['Comment']['user_id'] = $this->Auth->user('id');
     if ($this->Comment->save($this->request->data)) {
        $this->Session->setFlash(__('Your comment has been saved.'));
        return $this->redirect($this->referer());
      }
      $this->Session->setFlash(__('Unable to add you comment.'));
    }
  }

  public function delete($id = null){
    if($this->request->is('get')){
      throw new MethodNotAllowedException();
    }

    if($this->Comment->delete($id)){
      $this->Session->setFlash(
                               __('The comment with id:%s ha been deleted.',h($id))
                               );
    }else {
      $this->Session->setFlash(
                               __('The comment with id:%s could not be deleted.',h($id))
                               );
    }
    
   return $this->redirect($this->referer());
  }
}
