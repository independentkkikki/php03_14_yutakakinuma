<?php
require_once('funcs.php');

$name =$_POST['name'];
$lid =$_POST['lid'];
$lpw =$_POST['lpw'];
// $kanri_flg =$_POST['kanri_flg'];
// $life_flg =$_POST['life_flg'];
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
$stmt = $pdo->prepare("INSERT INTO 
                        gs_user_table(name, lid, lpw,kanri_flg,life_flg)
                        VALUES(:name, :lid, :lpw, :kanri_flg, :life_flg)"
                      );
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);


$status = $stmt->execute();


if($status==false){
  spl_error($stmt);
}else{
  redirect('index.php');
}

?>




