<?php
require_once('funcs.php');
//1.  DB接続します
$pdo = db_conn();
$id = $_GET['id'];

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_user_table WHERE id=' . $id . ';');
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($status);
}else{
   
    $result = $stmt->fetch();

    if ($result['kanri_flg']) {
        $kanri_flg = 'checked';
    } else {
        $kanri_flg = '';
    }

    if ($result['life_flg']) {
        $life_flg = 'checked';
    } else {
        $life_flg = '';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div class="jumbotron">
            <fieldset>
                <legend>会員詳細・変更</legend>
                <label>名前：<input type="text" name="name" value="<?= $result['name'] ?>"></label><br>
                <label>ID：<input type="text" name="lid" value="<?= $result['lid'] ?>"></label><br>
                <label>PW：<input type="text" name="lpw" value="<?= $result['lpw'] ?>"></label><br>
                <label>管理者：<input type="checkbox" name="kanri_flg" value="1" <?= $kanri_flg ?>></label><br>
                <label>在職者：<input type="checkbox" name="life_flg" value="1" <?= $life_flg ?>></label><br>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>
    </form>
</body>



</html>
