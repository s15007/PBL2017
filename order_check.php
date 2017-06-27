<?php
if (!isset($_SESSION)) session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>PBL2017</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/order_check.css">
</head>
<body>
<?php require_once 'header.php'; ?>
<?php
$time = strtotime($_POST['receiving_date']);
$date = date('Y-m-d', $time);
?>
<main>
    <h1 id="p_name"><?php echo $_GET['name']; ?></h1>
    <img src="<?php echo $_GET['image']; ?>">
    <form method="post" action="functions/addCart.php?pname=<?php
    echo $_GET['name'];?>&num=<?php
    echo $_POST['product_number'];?>&tray=<?php
    echo $_POST['trayName'];?>&root=<?php
    echo $_POST['selectGraft'];?>&price=<?php
    echo $_POST['hidden_price'];?>&image=<?php
    echo $_GET['image'];?>&receiving-date=<?php
    echo $date?>">

        <div class="colum" style="margin-top: 0;">
            <label>トレイ規格</label><h3 id="tray"><?php echo $_POST['trayName']; ?></h3>
            <hr>
        </div>

        <div class="colum">
            <label>苗数量</label><h3 id="num"><?php echo $_POST['product_number']; ?></h3>
            <hr>
        </div>

        <div class="colum">
            <label>台木</label><h3 id="graft"><?php echo $_POST['selectGraft']; ?></h3>
            <hr>
        </div>

        <div class="colum">
            <label>育苗方法</label><h3><?php echo $_POST['howToGrow']; ?></h3>
            <hr>
        </div>

        <div class="colum">
            <label>引き取り日</label><h3><?php echo $date;?></h3>
            <hr>
        </div>

        <div class="colum price">
            <label>合計金額</label><h3 id="price"><?php echo $_POST['price']; ?></h3>
            <hr>
        </div>

        <div class="colum buttons">
            <input id="button" type="button" onclick="location.href=
                    'order_detail.php?name=<?php echo $_GET['name'];
                    ?>&image=<?php echo $_GET['image'];
                    ?>'" value="戻る" />
            <input id="button" type="submit" value="カートに入れる" />
        </div>

    </form>
</main>
</body>
</html>