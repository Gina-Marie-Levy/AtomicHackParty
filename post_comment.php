<?php
require('Action.php');

$db = new Action();
$added = $db->add_comment($_POST);

if($added) {
  header( 'Location: index.php' );
}
else {
  header( 'Location: index.php?error=Your comment was not posted due to errors in your form submission' );
}
?>