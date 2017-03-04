<?php
date_default_timezone_set('UTC');

class Action {
  
  private $data = array();
  
  function __construct() {
    session_start();
    
    if( isset($_SESSION['blog_comments']) == true ){
      $this->data = $_SESSION['blog_comments'];
    }
  }

  /**
   * Get all comments for the given post.
   */
  function get_comments($comment_post_ID) {
    $comments = array();
    if( isset($this->data[$comment_post_ID]) == true ) {
      $comments = $this->data[$comment_post_ID];
    }
    return $comments;
  }
  
  /**
   * Get all comments.
   */
  function get_all_comments() {
    return $this->data;
  }
  
  /**
   * Store the comment.
   */
  function add_comment($vars) {
    
    $added = false;
    
    $comment_post_ID = $vars['comment_post_ID'];
    $input = array(
     'comment_author' => $vars['comment_author'],
     'email' => $vars['email'],
     'comment' => $vars['comment'],
     'comment_post_ID' => $comment_post_ID,
     'date' => date('r'));
    
    if($this->validate_input($input) == true) {
      if( isset($this->data[$comment_post_ID]) == false ) {
        $this->data[$comment_post_ID] = array();
      }
      
      $input['id'] = uniqid('comment_');
      
      $this->data[$comment_post_ID][] = $input;
      
      $this->sync();
      
      $added = $input;
    }
    return $added;
  }
  
  function delete_all() {
    $this->data = array();
    $this->sync();
  }
  
  private function sync() {
    $_SESSION['blog_comments'] = $this->data;    
  }
  

?>