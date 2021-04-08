<?php

$id = $_GET["id"];



require_once('funcs.php');
$pdo = db_conn();
$stmt = $pdo->prepare('DELETE FROM gs_user_table WHERE id = :id');

$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();
if ($status == false) {

  spl_error($stmt);
  
} else {
 
  redirect('select.php');
  
}