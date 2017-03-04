<?php
require('Action.php');

$db = new Action();
$db->delete_all();
  
print_r($db->get_all_comments());
?>