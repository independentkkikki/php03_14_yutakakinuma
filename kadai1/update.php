<?php
require_once('funcs.php');

$bookname =$_POST['bookname'];
$bookurl =$_POST['bookurl'];
$bookcomment =$_POST['bookcomment'];
$id = $_POST["id"];



//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare('UPDATE 
                        gs_bm_table SET bookname=:bookname, bookurl=:bookurl, bookcomment=:bookcomment,indate=sysdate() WHERE id= :id ;'
                      );

//  2. バインド変数を用意
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);  
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  spl_error($stmt);
}else{
  redirect('select.php');
}
?>
