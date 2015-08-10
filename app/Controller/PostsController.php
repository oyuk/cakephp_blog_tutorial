<?php

class PostsController extends AppController {
  public $helper = array('Html','Form','Session');
  public $components = array('Session');

  public function index() {
    $this->set('posts', $this->Post->find('all'));
    $this->set('user', $this->Auth->user());
  }

  public function view($id = null){
    if(!$id){
      throw new NotFoundException(__('Invalid post'));
    }
    
    $post = $this->Post->findById($id);

    if(!$post){
      throw new NotFoundException(__('Invalid post'));
    }

    $this->set('post',$post);
    $this->set('user_id',$this->Auth->user('id'));
  }

  public function add() {
    if ($this->request->is('post')) {
      $this->request->data['Post']['user_id'] = $this->Auth->user('id');
      if ($this->Post->save($this->request->data)) {
        $this->Session->setFlash(__('Your post has been saved.'));
        return $this->redirect(array('action'=>'index'));
      }
      $this->Session->setFlash(__('Unable to add you post.'));
    }
  }

  public function edit($id = null) {
    if(!$id){
      throw new NotFoundException(__('Invalid post'));
    }
    
    $post = $this->Post->findById($id);
    if(!$post){
      throw new NotFoundException(__('Invalid post'));
    }
    
    if ($this->request->is(array('put','post'))) {
      $this->Post->id = $id;
      if ($this->Post->save($this->request->data)) {
        $this->Session->setFlash(__('Your post has been updated.'));
        return $this->redirect(array('action'=>'index'));
      }
      $this->Session->setFlash(__('Unable to add you post.'));
    }

    if (!$this->request->data){
      $this->request->data = $post;
    }
   
  }

  public function delete($id = null){
    if($this->request->is('get')){
      throw new MethodNotAllowedException();
    }

    if($this->Post->delete($id)){
      $this->Session->setFlash(
                               __('The post with id:%s ha been deleted.',h($id))
                               );
    }else {
      $this->Session->setFlash(
                               __('The post with id:%s could not be deleted.',h($id))
                               );
    }
    
    return $this->redirect(array('action'=>'index'));
  }

  public function isAuthorized($user){
    if($this->action === 'add'){
      return true;
    }

    if(in_array($this->action,array('edit','delete'))) {
      $postId = (int)$this->request->params['pass'][0];
      if($this->Post->isOwnedBy($postId,$user['id'])) {
        return true;
      }
    }

    return parent::isAuthorized($user);
  }
  
}