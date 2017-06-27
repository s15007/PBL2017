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
    <script src="js/order_detail.js"></script>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/order_detail.css">
</head>
<body>
<?php require_once 'header.php'; ?>
<?php require_once 'functions/php_functions.php'; ?>

<?php
$productName = $_GET['name'];
switch ($productName) {
    case "とまと":
        $checkProduct = "checkTomato()";
        break;
    case "きゅうり":
        $checkProduct = "checkCucumber()";
        break;
    case "レタス":
        $checkProduct = "checkLettuce()";
        break;
}
?>
<script>
    var checkproduct = new CheckProduct();
</script>

<main>

    <h1 id="productName"><?php echo $_GET['name']; ?></h1>
    <img src="<?php echo $_GET['image']; ?>">
    <form method="post" action="order_check.php?pid=<?php
    echo $_GET['pid']; ?>&image=<?php
    echo $_GET['image']; ?>&name=<?php
    echo $_GET['name']; ?>" id="orderDetail" name="orderDetail">

        <div class="colum form-group">
            <h2>育苗方法</h2>
            <select class="form-control" id="sel1" name="howToGrow" onchange="<?php echo "checkproduct.".$checkProduct; ?>">
                <option value='' disabled selected style='display:none;'>育苗方法を選択</option>
                <option>自根</option>
                <option>接木</option>
            </select>
        </div>
        <div class="colum">
            <h2>トレイ規格</h2>
            <select class="form-control" id="sel1" name="trayName" onchange="<?php echo "checkproduct.".$checkProduct; ?>">
                <option value='' disabled selected style='display:none;'>トレイ規格を選択</option>
                <?php get_tray(); ?>
            </select>
        </div>
        <div class="colum">
            <h2>引き取り日</h2>
            <input type="date" id="date" name="receiving_date" onchange="checkInput()">
        </div>
        <div class="colum">
            <h2>苗数量</h2>
            <input type="number" min="1" id="p_num" name="product_number" class="form-control" max="10000" placeholder="苗数量を入力" onchange="checkInput()">
            <span class="err" id="err" style="color: red;"></span>
        </div>
        <div class="colum">
            <h2>合計</h2>
            <input type="text" readonly id="price" name="price">
            <input type="hidden" id="hidden_price" name="hidden_price">
        </div>
        <div class="colum">
            <h2>台木</h2>
            <select class="form-control" id="graftForm" name="selectGraft" onchange="<?php echo "checkproduct.".$checkProduct; ?>">
                <option value='' disabled selected style='display:none;'>台木を選択</option>
                <?php get_rootstock(); ?>
            </select>
        </div>
        <div class="colum buttons">
            <div class="buttons-inside">
                <input id="button" type="submit" onmouseover="submitMouseover()" onmouseout="submitMouseout()" value="決定" style="float: right;"/>
                <input id="button" type="button" value="戻る" style="float: left;"/>
            </div>
        </div>
    </form>

</main>
</body>
</html>
