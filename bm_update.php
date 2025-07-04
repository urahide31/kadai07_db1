<?php
include("funcs.php");

//エラー表示
ini_set("display_errors", 1);

//1. POSTデータ取得
$id     = $_POST["id"];
$bkname = $_POST['bkname'];
$bkurl = $_POST['bkurl'];
$comment = $_POST['comment'];


//2. DB接続します
$pdo = db_conn();


//３．データ更新SQL作成
$sql = "UPDATE gs_bm_table SET bkname=:bkname,bkurl=:bkurl,comment=:comment WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bkname',     $bkname,    PDO::PARAM_STR);
$stmt->bindValue(':bkurl',      $bkurl,     PDO::PARAM_STR);
$stmt->bindValue(':comment',    $comment,   PDO::PARAM_STR);
$stmt->bindValue(':id',         $id,        PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
    //*** function化する！*****************
    sql_error($stmt);
}else{
    //*** function化する！*****************
    redirect("select.php");
}


?>