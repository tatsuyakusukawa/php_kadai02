<?php

    // ID取得
    $id = $_GET["id"];

    // DB接続
    try {
        $pdo = new PDO('mysql:dbname=php_kadai02;charset=utf8;host=localhost','root','');
    } catch (PDOException $e) {
        exit('DBConnectError:'.$e->getMessage());
    }

    // データ取得SQL作成
    $stmt = $pdo->prepare("SELECT * FROM gschannel WHERE id=:id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    // プロフィールIDに紐づいたコメントのSQL取得
    $stmt2 = $pdo->prepare("SELECT * FROM reply WHERE post_id=:id");
    $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
    $status2 = $stmt2->execute();

    // 画像データ取得
    $sql = 'SELECT * FROM gschannel WHERE id = :id LIMIT 1';
    $stmt3 = $pdo->prepare($sql);
    $stmt3->bindValue(':id', (int)$_GET['id'], PDO::PARAM_INT);
    $stmt3->execute();

    $image = $stmt3->fetch();
    $img = base64_encode($image['image']);



    // IDについているデータを表示
    $view="";   
    if($status==false) {
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        $row = $stmt->fetch();
        // 以下viewに表示するためのHTMLを記述
        $view .= '<p>';
        $view .= "投稿日時：".$row["created_at"];
        $view .= "名前：".$row["name"];

        // class
        $view .= "<br>class:".$row["class"];
        

        
        $view .= "タイトル:".$row["title"];

        // 画像表示
        $view .= '<br><img src="data:image/jpeg;base64,'.$img.'">';
        $view .= "<br>内容:".$row["content"];
        $view .= '<br>---------------------------------</p>';

    }




    // プロフィールIDに紐づいているコメントの表示
    $view2="";

    if($status2==false) {
        $error = $stmt2->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        while( $row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
            // 以下viewに表示するためのHTMLを記述
            $view2 .= '<p>';
            $view2 .= "投稿日時：".$row2["created_at"];
            $view2 .= "  名前：".$row2["reply_name"];
            $view2 .= "<br>コメント:".$row2["reply_content"];
            $view2 .= '<br>---------------------------------</p>';
        }
    }




?>

<!-- IDに紐づいている情報のみ表示 -->
<!DOCTYPE html>

<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title><?php echo $row["title"]?></title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }

    </style>
</head>


<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">

                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">投稿一覧へ戻る</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
        <body?>
    <!-- まずviewを表示 -->
    <div>
        <div class="container jumbotron"><?=$view?></div>
    </div>

    <!-- 次にcommentを表示 -->
    <div>
        <div class="container jumbotron"><?=$view2?></div>
    </div>

    <!-- コメント投稿フォーム　-->
    <form method="POST" action="insert_comment.php">
        <div class="jumbotron">
            <fieldset>
                <legend>コメント投稿</legend>
                <label>名前：<input type="text" name="reply_name"></label><br>
                <label><textArea name="reply_content" rows="4" cols="40"></textArea></label><br>
                <input type="hidden" name="post_id" value="<?=$id?>">
                <input type="submit" value="送信">
            </fieldset>
        </div>

    <!-- 終了 -->

    </body>

</html>


