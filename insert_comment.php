<?php


// detailからのPOSTデータ取得
$id = $_POST["post_id"];
$reply_name = $_POST["reply_name"];
$reply_content = $_POST["reply_content"];

// 1.  DB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=php_kadai02;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
    }

// 2. データ登録SQL作成
// 1. SQL文を用意

$stmt = $pdo->prepare("INSERT INTO reply (`post_id`, `id`, `reply_name`, `reply_content`, `created_at`) 
VALUES (:post_id, NULL, :reply_name, :reply_content, sysdate())");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':post_id', $id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':reply_name', $reply_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':reply_content', $reply_content, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


//  3. 実行
$status = $stmt->execute();



// 4. データ登録処理後
if($status === false){
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
$error = $stmt->errorInfo();
exit('ErrorMessage:'.$error[2]);
}else{
// 5. index.phpへリダイレクト
header('Location: sled.php?id='.$id);
}
?>
