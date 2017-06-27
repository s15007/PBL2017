<?php
// セッション開始
if (!isset($_SESSION)) session_start();
require_once 'functions/db_connect.php';
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
        try {
            $pdo = new PDO(DSN, DB_USER, DB_PWD);
            $pdo->query('SET NAMES UTF8');
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
                // 該当データなし
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
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
    <h2>業界トップクラスの品揃えと激安価格<br>
        １回の発注で１種類最大１万まで注文可能<br>
        苗ファクトリーの会員様限定オンライン発注サイト</h2>

    <form action="" method="POST">
        <input type="password" style="margin: 0 0 0 -500px;padding:0;position: absolute"/>
        <input type="email" style="margin: 0 0 0 -500px;padding:0;position: absolute"/>
        <br>
        <input type="email" name="mail" placeholder="メールアドレスを入力してください"/>
        <br>
        <input type="password" name="pass" placeholder="パスワードを入力してください" />
        <br>
        <input type="submit" name="login" value="ログイン">
        <?php echo "<span style=\"color:red;\">".$errorMessage."</span>"; ?>
    </form>

    <img src="images/wood.gif" style="position:fixed;bottom:0;right:0; z-index: -1;">
    <img src="images/wood2.gif" style="position: fixed;bottom:0;left:0; z-index: -1;">
</div>

</body>
</html>
