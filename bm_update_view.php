<?php
//エラー表示
ini_set("display_errors", 1);

include("funcs.php");
session_start();
sschk();

//1. GETデータ取得
$id = $_GET['id'];


//2. DB接続します
//*** function化する！  *****************
$pdo = db_conn();


//3．データ取得SQL作成
$sql = "SELECT * FROM gs_bm_table WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id",$id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$values = "";
if($status==false) {
  sql_error($stmt);
}

$row = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>要注意顧客情報登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">顧客情報一覧へ</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>更新したい内容を入力して「更新」をクリック</legend>
     <label>顧客名：<input type="text" name="bkname" value="<?=$row["bkname"]?>"></label><br>
     <label>連絡先：<input type="text" name="bkurl" value="<?=$row["bkurl"]?>"></label><br>
     <label>コメント：<textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <!-- idを隠して送信 -->
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
