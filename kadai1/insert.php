<?php
require_once('funcs.php');

$bookname =$_POST['bookname'];
$bookurl =$_POST['bookurl'];
$bookcomment =$_POST['bookcomment'];



//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO 
                        gs_bm_table(bookname, bookurl, bookcomment,indate)
                        VALUES(:bookname, :bookurl, :bookcomment, sysdate())"
                      );

//  2. バインド変数を用意
$stmt->bindValue(':bookname', $bookname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookurl', $bookurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bookcomment', $bookcomment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  spl_error($stmt);
}else{
  redirect('index.php');
}
?>
