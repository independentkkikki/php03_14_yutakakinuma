<?php
require_once('funcs.php');

$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

$view = "";
if ($status == false) {
    sql_error($status);
}else{
    while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result['id'] . '">';
        $view .= $result['name'] . "：" . $result['lid'] . "：". $result['lpw'];
        $view .= '</a>';

        $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= "   [削除]";
        $view .= '</a>';

        $view .= '</p>';
    }

}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ユーザーデータ</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<header>
    <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php">ユーザー登録</a>
        </div>
    </div>
    </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
<div class="container jumbotron">
         
            <?= $view ?>
        </div>
</div>
<!-- Main[End] -->

</body>
</html>