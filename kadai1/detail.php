<?php
require_once('funcs.php');
//1.  DB接続します
$pdo = db_conn();
$id = $_GET['id'];

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id=' . $id . ';');
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($status);
}else{
   
    $result = $stmt->fetch();

}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>

<body>

  
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>
  

    
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマークリスト</legend>
                <label>書籍名：<input type="text" name="bookname" value="<?= $result['bookname'] ?>"></label><br>
                <label>書籍URL：<input type="text" name="bookurl" value="<?= $result['bookurl'] ?>"></label><br>
                <label ><textArea name="bookcomment" rows="4" cols="40" placeholder="コメントを入力"><?= $result['bookcomment'] ?></textArea></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">

                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
 


</body>

</html>