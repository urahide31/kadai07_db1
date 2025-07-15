<?php
//エラー表示
ini_set("display_errors", 1);

include("funcs.php");

session_start();
// var_dump($_SESSION);
sschk();

//1.  DB接続します

$pdo = db_conn();

//２．データ登録SQL作成
$sql = "SELECT * FROM gs_bm_table;";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false) {
  //execute（SQL実行時にエラーがある場合）
  sql_error($stmt);

}else{
  // while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
  //   //var_dump($res);
  //   $view .= '<p><a href="bm_update_view.php?id='.$res['id'].'">';
  //   $view .= $res['id'].'.'.$res['bkname'].'.'.$res['bkurl'].'.'.$res['comment'];
  //   if($_SESSION["kanri_flg"] == "1" ){
  //     $view .= '</a><a href="bm_delete.php?id='.$res['id'].'">[削除]</p>';
  //   };
  //全データ取得
  $values =  $stmt->fetchAll(PDO::FETCH_ASSOC);//PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマーク一覧表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header"><a class="navbar-brand" href="index.php">データ登録</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="login.php">ログイン</a></div>
      <div class="navbar-header"><a class="navbar-brand" href="logout.php">ログアウト</a></div>
      <?php if($_SESSION["kanri_flg"] == "1"){ ?>
        <div class="navbar-header"><a class="navbar-brand" href="user.php">ユーザ登録</a></div>
      <?php } ?>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div>2025/07/15 ログイン・ログアウト機能を追加しました。一覧のデザインを改善しました。</div>
    <div>2025/07/08 DBの更新・削除処理を追加しました</div>
    <div class="container jumbotron">
    <table class="table">
      <tr>
        <th>id</th>
        <th>書籍名</th>
        <th>書籍URL</th>
        <th>コメント</th>
        <th>操作</th>
        <?php
          if($_SESSION["kanri_flg"] == "1"){ ?>
          <th>削除</th>
        <?php  } ?>
      </tr>
    <?php foreach($values as $v){ ?>
      <tr>
        <td><?=$v["id"]?></td>
        <td><?=$v["bkname"]?></td>
        <td><?=$v["bkurl"]?></td>
        <td><?=$v["comment"]?></td>
        <td> <a href="bm_update_view.php?id=<?=$v["id"]?>">[詳細]</a></td>
        <?php
          if($_SESSION["kanri_flg"] == "1"){ ?>
            <td><a href="bm_delete.php?id=<?=$v["id"]?>" onclick="return confirm('本当に削除しますか？');">[削除]</a></td>
          <?php }?>
        </tr>
    <?php } ?>
    </table>
    </div>
   
</div>
<!-- Main[End] -->


<script>
 


</script>
</body>
</html>
