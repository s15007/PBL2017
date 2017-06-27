<?php
require_once 'db_connect.php';

function get_tray() {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES utf8');

        $stmt = $dbh->prepare('select tray_name from tray');
        $stmt->execute();
        while ($TrayData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option>".$TrayData['tray_name']."</option>";
        }
        $dbh = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function get_rootstock() {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES utf8');

        $stmt = $dbh->prepare('select rootstock_name from rootstock');
        $stmt->execute();
        while($RootstockData = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option>".$RootstockData['rootstock_name']."</option>";
        }
        $dbh = null;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}

function show_product() {
    $ProductData = array();
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT product_id, product_name, product_image FROM product'
        );
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $ProductData[] = array(
                'product_id' => $data['product_id'],
                'product_name' => $data['product_name'],
                'product_image' => $data['product_image']
            );
        }
        return $ProductData;
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getCartNumber($userid) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'select count(user_id) from cart where user_id = "'.$userid.'"'
        );
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['count(user_id)'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getOrderNumber($userid) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'select count(user_id) from `order` where user_id = "'.$userid.'"'
        );
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['count(user_id)'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getProductId($productName) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT product_id FROM product WHERE product_name = "'.$productName.'"'
        );
        $stmt->execute();
        $productid = $stmt->fetch(PDO::FETCH_ASSOC);
        return $productid['product_id'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getProductName($productid) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT product_name FROM product WHERE product_id = "'.$productid.'"'
        );
        $stmt->execute();
        $productname = $stmt->fetch(PDO::FETCH_ASSOC);
        return $productname['product_name'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getTrayId($trayName) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT tray_id FROM tray WHERE tray_name = "'.$trayName.'"'
        );
        $stmt->execute();
        $trayid = $stmt->fetch(PDO::FETCH_ASSOC);
        return $trayid['tray_id'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getTrayName($trayid) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT tray_name FROM tray WHERE tray_id = "'.$trayid.'"'
        );
        $stmt->execute();
        $trayname = $stmt->fetch(PDO::FETCH_ASSOC);
        return $trayname['tray_name'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getRootstockId($rootstockName) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT rootstock_id FROM rootstock WHERE rootstock_name = "'.$rootstockName.'"'
        );
        $stmt->execute();
        $rootstockid = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rootstockid['rootstock_id'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getRootstockName($rootstockid) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT rootstock_name FROM rootstock WHERE rootstock_id = "'.$rootstockid.'"'
        );
        $stmt->execute();
        $rootstockname = $stmt->fetch(PDO::FETCH_ASSOC);
        return $rootstockname['rootstock_name'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getDaysToHand($order_id) {
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT datediff(receiving_date, sysdate())  from `order` WHERE order_id = "'.$order_id.'"'
        );
        $stmt->execute();
        $days = $stmt->fetch(PDO::FETCH_ASSOC);
        return $days['datediff(receiving_date, sysdate())'];
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getCartData($userid) {
    $cartData = array();
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT * FROM cart WHERE user_id = "'.$userid.'"'
        );
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cartData[] = array(
                'product_id' => $data['product_id'],
                'product_num' => $data['product_num'],
                'tray_id' => $data['tray_id'],
                'rootstock_id' => $data['rootstock_id'],
                'total_price' => $data['total_price'],
                'product_image' => $data['product_image'],
                'receiving_date' => $data['receiving_date']
            );
        }
        return $cartData;
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}

function getOrderData($userid) {
    $orderData = array();
    try {
        $dbh = new PDO(DSN, DB_USER, DB_PWD);
        $dbh->query('SET NAMES UTF8');
        $stmt = $dbh->prepare(
            'SELECT * FROM `order` WHERE user_id = "'.$userid.'"'
        );
        $stmt->execute();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $orderData[] = array(
                'order_id' => $data['order_id'],
                'order_date' => $data['order_date'],
                'product_id' => $data['product_id'],
                'product_num' => $data['product_num'],
                'tray_id' => $data['tray_id'],
                'tray_num' => $data['tray_num'],
                'rootstock_id' => $data['rootstock_id'],
                'receiving_date' => $data['receiving_date']
            );
        }
        return $orderData;
    } catch (PDOException $pdoe) {
        return $pdoe->getMessage();
    }
}