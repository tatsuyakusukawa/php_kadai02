<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>G'sチャンネル</title>
</head>
<body>
    <h1>G'sチャンネル</h1>
    <a href="index.php">戻る</a>

    <form action="post_content.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">名前：</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="class">クラス</label>
            <select name="class" id="class">
                <option value="東京DEV25期">東京DEV25期</option>
                <option value="札幌DEV6期">札幌DEV6期</option>
            </select>
        </div>
        <div>
            <label for="title">投稿タイトル</label>
            <input type="text" name="title" id="title" >
        </div>
        <div>
            <label for="content">投稿内容</label>
            <textarea name="content" id="content" cols="30" rows="10"></textarea>
        </div>
        <div>
        <label>画像を選択</label>
            <input type="file" name="image" required>
        </div>
        <div>
            <input type="submit" value="送信">
        </div>

    </form>

</body>
</html>