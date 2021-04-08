<?php
require_once('funcs.php');

$id = $_POST["id"];
$name = $_POST["name"];
$lid  = $_POST["lid"];
$lpw = $_POST["lpw"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];
if (isset($_POST["kanri_flg"])) {
  $kanri_flg = 1;
} else {
  $kanri_flg = 0;
}

if (isset($_POST["life_flg"])) {
  $life_flg = 1;
} else {
  $life_flg = 0;
}
$pdo = db_conn();

$stmt = $pdo->prepare(
  'UPDATE
      gs_user_table
  SET
      name = :name, lid = :lid, lpw = :lpw, kanri_flg = :kanri_flg, life_flg = :life_flg
  WHERE
      id = :id;'
);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); 

if ($status == false) {
  spl_error($stmt);
  
} else {
  redirect("select.php");
}
