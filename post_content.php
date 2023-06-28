<?php

// postデータを取得
$name = $_POST['name'];
$class = $_POST['class'];
$title = $_POST['title'];
$content = $_POST['content'];


// 画像データを取得
$image = file_get_contents($_FILES['image']['tmp_name']);
$image_type = $_FILES['image']['type'];

// DB接続
try {
    //ID:'root', Password: xamppは 空白 ''
    $pdo = new PDO('mysql:dbname=php_kadai02;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
    }

// データ取得SQL作成

// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gschannel(id, name, class, title, content, image, image_type,created_at)
VALUES(NULL, :name, :class, :title, :content, :image, :image_type, sysdate())");
//  2. バインド変数を用意
$stmt->bindValue(':name', $name, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':class', $class, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':title', $title, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':content', $content, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $image, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image_type', $image_type, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)


//  3. 実行
$status = $stmt->execute();



//  4．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:".$error[2]);
}else{
    //５．index.phpへリダイレクト
    header('Location: index.php');
}

?>
