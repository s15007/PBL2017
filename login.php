<?php
// セッション開始
session_start();
$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "yc20140219";  // ユーザー名のパスワード
$db['dbname'] = "PBL2017";  // データベース名
// エラーメッセージの初期化
$errorMessage = "";
// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["mail"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["pass"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
    if (!empty($_POST["mail"]) && !empty($_POST["pass"])) {
        // 入力したユーザIDを格納
        // 2. ユーザIDとパスワードが入力されていたら認証する
        $dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
        // 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            $stmt = $pdo->prepare('SELECT user_id, mail_address, password FROM user ');
            $stmt->execute();
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($_POST['pass']==$row['password'] && $_POST['mail']==$row['mail_address']) {
                    session_regenerate_id(true);
                    $_SESSION['userid'] = $row['user_id'];

                    header("Location: home.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                    $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
                }
            } else {
                // 4. 認証成功なら、セッションIDを新規に発行する
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバック時のみ表示）
            // echo $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="css/login.css" type="text/css">
</head>
<meta charset="UTF-8">
<title>login</title>
<body>
<header>
    <h1>苗ファクトリーOnline</h1>
</header>


<div class="login">
    <p>
    <h2>業界トップクラスの品揃えと激安価格<br>
        １回の発注で１種類最大１万まで注文可能<br>
        苗ファクトリーの会員様限定オンライン発注サイト</h2>
    </p>

    <form action="" method="POST">
        <p>
            <input type="email" name="mail" placeholder="メールアドレスを入力してください"/>
        </p>
        <p>
            <input type="password" name="pass" placeholder="パスワードを入力してください" />
        </p>

        <input type="submit" name="login" value="ログイン">
    </form>

    <?php echo $errorMessage; ?>

    <img src="images/wood.gif" width="500" style="position:absolute;bottom:0px;right:0px;">
    <img src="images/wood2.gif" width="350" style="position: absolute;bottom:0px;left:0px;">
</div>

</body>
</html>
