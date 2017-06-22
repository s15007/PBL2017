<?php
if (!isset($_SESSION)) session_start();
require_once 'functions/db_connect.php';
try {
    $pdo = new PDO(DSN, DB_USER, DB_PWD);
    $pdo->query('SET NAMES UTF8');
    $stmt = $pdo->prepare(
            'SELECT o.order_id, product.product_name, product.product_image, o.product_num, tray.tray_name, rootstock.rootstock_name
                        FROM `order` o
                        JOIN product ON o.product_id = product.product_id
                        JOIN tray ON o.tray_id = tray.tray_id
                        JOIN rootstock on o.rootstock_id = rootstock.rootstock_id
                        WHERE o.user_id = "'.$_SESSION['userid'].'";');
    $stmt->execute();
    while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {

        $orderData[] = array(
                'order_id'        => $data['order_id']
                ,'product_name'      => $data['product_name']
                ,'tray_name'        => $data['tray_name']
                ,'rootstock_name'   => $data['rootstock_name']
                ,'product_num'   => $data['product_num']
                ,'product_image'      => $data['product_image']
        );
    }
} catch (PDOException $e) {
     echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/header.css" type="text/css">
    <link rel="stylesheet" href="css/home.css" type="text/css">

</head>
<meta charset="UTF-8">
<title>PBL</title>
<body>

<?php require_once 'header.php'; ?>

<main class="clearfix">
    <div class="header">
        <img src="images/tyumonnae.png">
    </div>
    <?php if (getOrderNumber($_SESSION['userid'] > 0)) { ?>
    <?php foreach ($orderData as $key => $list) { ?>
    <div class="colum clearfix">
        <img src="<?php echo $list['product_image']; ?>">
        <div class="details">

            <h1><?php echo $list["product_name"]?></h1><span id="hikitoribi">引き取り日まであと<span<?php echo getDaysToHand($list['order_id']); ?>日</span>


            <div class="dcol">
                <p>
                    トレイ規格：<span><?php echo $list["tray_name"]?></span>
                    育苗方法：<span><?php if($list["rootstock_name"] == "なし") { echo "自根";} else { echo "接木";}?></span>
                </p>
            </div>

            <div class="dcol">
                <p>
                    台木：<span><?php echo $list["rootstock_name"]?></span>
                    注文数：<span><?php echo $list["product_num"]?></span>
                    合計：<span>30000円</span>
                </p>
            </div>

        </div>
    </div>
    <?php } ?>
    <?php } else { ?>
        <p style="color: red; text-align: center; font-size: 1.5em; margin-top: 30px;">何も注文されていません。</p>
    <?php } ?>
</main>
</body>
</html>

