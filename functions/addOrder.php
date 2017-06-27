<?php
session_start();

require_once 'db_connect.php';
require_once 'php_functions.php';

$cartData = getCartData($_SESSION['userid']);

foreach ($cartData as $key => $list) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'insert into `order`(order_date, user_id, product_id, product_num, total_price, tray_id, tray_num, rootstock_id, receiving_date) 
            VALUES (sysdate(), "'.$_SESSION['userid'].'", "'.$list['product_id'].'", "'.$list['product_num'].'", "'.$list['total_price'].'", "'.$list['tray_id'].'", "300", "'.$list['rootstock_id'].'", "'.$list['receiving_date'].'")'
        );
        $stmt->execute();
    } catch (PDOException $pdoe) {
        echo $pdoe->getMessage();
    }
}

try {
    $dbh = new PDO(DSN, DB_USER, DB_PWD);
    $dbh->query('SET NAMES UTF8');
    $stmt = $dbh->prepare(
        'TRUNCATE TABLE `cart`'
    );
    $stmt->execute();
    header("Location: ../home.php");
} catch (PDOException $pdoe) {
    echo $pdoe->getMessage();
}