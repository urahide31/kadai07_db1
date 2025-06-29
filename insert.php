<?php
//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$bkname = $_POST['bkname'];
$bkurl = $_POST['bkurl'];
$comment = $_POST['comment'];


//2. DB接続します
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=azureokapi71_gs_kadai_db;charset=utf8;host=mysql80.azureokapi71.sakura.ne.jp','****','*****');
} catch (PDOException $e) {
  exit('DBConnection Error:'.$e->getMessage());
}


//３．データ登録SQL作成
$sql = "INSERT INTO gs_bm_table(bkname,bkurl,comment,indate)VALUES(:bkname, :bkurl, :comment, sysdate());";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bkname', $bkname, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':bkurl', $bkurl, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("SQL_Error:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit();
}
?>
