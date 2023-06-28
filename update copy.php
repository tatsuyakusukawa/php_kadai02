<?php


// 1.  DB接続します
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=com_type;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
    }

// 2. データ登録SQL作成
// 1. SQL文を用意

$stmt = $pdo->prepare("UPDATE profile SET name=:name, com_type=:com_type, ok_content=:ok_content, ng_content=:ng_content, other_content=:other_content WHERE id=:id");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':name', $_POST["name"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':com_type', $_POST["com_type"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ok_content', $_POST["ok_content"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':ng_content', $_POST["ng_content"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':other_content', $_POST["other_content"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $_POST["id"], PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)


//  3. 実行
$status = $stmt->execute();


// 4. データ登録処理後
if($status === false){
//SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
$error = $stmt->errorInfo();
exit('ErrorMessage:'.$error[2]);
}else{
// 5. index.phpへリダイレクト
header('Location: index.php');
}
?>
