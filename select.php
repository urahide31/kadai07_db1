<?php
//エラー表示
ini_set("display_errors", 1);

include("funcs.php");

//1.  DB接続します
// try {
  //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=azureokapi71_gs_kadai_db;charset=utf8;host=mysql80.azureokapi71.sakura.ne.jp','*****','*****');
// } catch (PDOException $e) {
//   exit('DBConnection Error:'.$e->getMessage());
// }

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
  while( $res = $stmt->fetch(PDO::FETCH_ASSOC)){
    //var_dump($res);
    $view .= '<p><a href="bm_update_view.php?id='.$res['id'].'">';
    $view .= $res['id'].'.'.$res['bkname'].'.'.$res['bkurl'].'.'.$res['comment'];
    $view .= '</a><a href="bm_delete.php?id='.$res['id'].'">[削除]</p>';
    // var_dump($view);
  }
}

//全データ取得
$values =  $stmt->fetchAll(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC[カラム名のみで取得できるモード]
//JSONい値を渡す場合に使う
// $json = json_encode($values,JSON_UNESCAPED_UNICODE);

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
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">ブックマーク登録画面へ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->


<!-- Main[Start] -->
<div>
    <div>New! DBの更新・削除処理を追加しました</div>
    <div>注意！[削除]をクリックするとすぐに削除されます</div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->


<script>
  //JSON受け取り
  const a = '<?php echo $json; ?>';
  console.log(JSON.parse(a));


</script>
</body>
</html>
