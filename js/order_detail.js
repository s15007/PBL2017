window.onload = function () {
    var productName = document.getElementById("productName").innerHTML;
    var date = document.getElementById("date");
    var p_num = document.getElementById("p_num");
    date.style.border = 'solid 1px #ccc';
    p_num.style.border = 'solid 1px #ccc';
    // 品目ごとのセレクトカラムの初期表示
    switch (productName) {
        case "レタス":
            document.orderDetail.selectGraft.options[2].disabled = true;
            document.orderDetail.selectGraft.options[3].disabled = true;
            document.orderDetail.selectGraft.options[4].disabled = true;
            document.orderDetail.selectGraft.options[5].disabled = true;
            document.orderDetail.howToGrow.options[1].selected = true;
            document.orderDetail.howToGrow.options[2].disabled = true;
            document.orderDetail.trayName.options[3].disabled = true;
            document.orderDetail.trayName.options[4].disabled = true;
            document.orderDetail.selectGraft.options[1].selected = true;
            break;
        case "とまと":
            document.orderDetail.selectGraft.options[2].disabled = true;
            document.orderDetail.selectGraft.options[3].disabled = true;
            break;
        case "きゅうり":
            document.orderDetail.selectGraft.options[4].disabled = true;
            document.orderDetail.selectGraft.options[5].disabled = true;
    }

    var button = document.getElementById("button");
    button.disabled = true;
    checkInput();
    DaysIncrease();
};

// フォームのセレクトカラムの制御
var CheckProduct = function() {

    CheckProduct.prototype.checkTomato = function () {

        switch (document.orderDetail.howToGrow.selectedIndex) {
            case 1:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = false;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                document.orderDetail.selectGraft.options[1].selected = true;
                break;
            case 2:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = true;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = false;
                document.orderDetail.selectGraft.options[5].disabled = false;
                break;
        }

        switch (document.orderDetail.trayName.selectedIndex) {
            case 1:
            case 2:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].selected = true;
                document.orderDetail.selectGraft.options[1].disabled = false;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                // 育苗方法の制御
                document.orderDetail.howToGrow.options[1].disabled = false;
                document.orderDetail.howToGrow.options[1].selected = true;
                document.orderDetail.howToGrow.options[2].disabled = true;
                break;
            case 3:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = true;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = false;
                document.orderDetail.selectGraft.options[5].disabled = true;
                document.orderDetail.selectGraft.options[4].selected = true;
                // 育苗方法の制御
                document.orderDetail.howToGrow.options[1].disabled = true;
                document.orderDetail.howToGrow.options[2].disabled = false;
                document.orderDetail.howToGrow.options[2].selected = true;
                break;
            case 4:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = true;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = false;
                document.orderDetail.selectGraft.options[5].selected = true;
                // 育苗方法の制御
                document.orderDetail.howToGrow.options[1].disabled = true;
                document.orderDetail.howToGrow.options[2].disabled = false;
                document.orderDetail.howToGrow.options[2].selected = true;
                break;

        }

        checkInput();
        DaysIncrease();
        DayController();
    };

    CheckProduct.prototype.checkCucumber = function () {

        switch (document.orderDetail.howToGrow.selectedIndex) {
            case 1:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].selected = true;
                document.orderDetail.selectGraft.options[1].disabled = false;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                break;
            case 2:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = true;
                document.orderDetail.selectGraft.options[2].disabled = false;
                document.orderDetail.selectGraft.options[3].disabled = false;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                break;
        }

        switch (document.orderDetail.trayName.selectedIndex) {
            case 1:
            case 2:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = false;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                document.orderDetail.selectGraft.options[1].selected = true;
                // 育苗方法の制御
                document.orderDetail.howToGrow.options[1].disabled = false;
                document.orderDetail.howToGrow.options[1].selected = true;
                document.orderDetail.howToGrow.options[2].disabled = true;
                break;
            case 3:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = true;
                document.orderDetail.selectGraft.options[2].disabled = false;
                document.orderDetail.selectGraft.options[3].disabled = true;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                document.orderDetail.selectGraft.options[2].selected = true;
                // 育苗方法の制御
                document.orderDetail.howToGrow.options[1].disabled = true;
                document.orderDetail.howToGrow.options[2].disabled = false;
                document.orderDetail.howToGrow.options[2].selected = true;
                break;
            case 4:
                // 台木選択の制御
                document.orderDetail.selectGraft.options[1].disabled = true;
                document.orderDetail.selectGraft.options[2].disabled = true;
                document.orderDetail.selectGraft.options[3].disabled = false;
                document.orderDetail.selectGraft.options[4].disabled = true;
                document.orderDetail.selectGraft.options[5].disabled = true;
                document.orderDetail.selectGraft.options[3].selected = true;
                // 育苗方法の制御
                document.orderDetail.howToGrow.options[1].disabled = true;
                document.orderDetail.howToGrow.options[2].disabled = false;
                document.orderDetail.howToGrow.options[2].selected = true;
                break;
        }



        checkInput();
        DaysIncrease();
        DayController();
    };

    CheckProduct.prototype.checkLettuce = function () {
        checkInput();
        DaysIncrease();
        DayController();
    }
};

hover = Boolean(false);

// フォームの中身のチェック
var checkInput = function () {
    var trayName = document.orderDetail.trayName.selectedIndex;
    var howToGrow = document.orderDetail.howToGrow.selectedIndex;
    var selectGraft = document.orderDetail.selectGraft.selectedIndex;
    var graftForm = document.getElementById("graftForm");
    var button = document.getElementById("button");
    var p_num = document.getElementById("p_num");
    var date = document.getElementById("date");

    if (trayName === 0 || howToGrow === 0 || selectGraft === 0 ||
        p_num.value === "" || p_num.value < 1 || date.value === "") {

        hover = false;
        button.style.color = '#ccc';
        button.style.borderColor = '#ccc';
        button.style.backgroundColor = 'white';
        button.style.boxShadow = 'none';
        button.disabled = true;

    } else {
        hover = true;
        submitMouseout();
    }

    var err = document.getElementById("err");
    if (p_num.value > 10000) {
        err.innerHTML = "苗数量は10000以内にしてください";
    } else {
        err.innerHTML = "";
    }

    if (trayName === 3 || trayName === 4) {
        if (selectGraft === 1) {
            hover = false;
            button.style.color = '#ccc';
            button.style.borderColor = '#ccc';
            button.style.backgroundColor = 'white';
            button.style.boxShadow = 'none';
            button.disabled = true;
            graftForm.style.border = 'solid 1px #ccc';
            graftForm.style.color = '#ff9090';
            graftForm.style.boxShadow = '0px 0px 6px 3px #ff9090';
        } else {
            graftForm.style.border = 'solid 1px #ccc';
            graftForm.style.color = 'black';
            graftForm.style.boxShadow = 'none';
        }
    } else {
        graftForm.style.border = 'solid 1px #ccc';
        graftForm.style.color = 'black';
        graftForm.style.boxShadow = 'none';
    }
    getPrice();
};

// 合計代金取得
var getPrice = function () {
    var productName = document.getElementById("productName").innerHTML;
    var tray = document.orderDetail.trayName.selectedIndex;
    var num = document.getElementById("p_num");
    var graft = document.orderDetail.selectGraft.selectedIndex;
    var price = document.getElementById("price");
    var hidden_price = document.getElementById("hidden_price");
    var total_price = 0;
    switch (productName) {
        case "レタス":
            if (tray === 1) total_price = 4;
            if (tray === 2) total_price = 6;
            total_price = total_price * num.value;
            break;
        case "とまと":
            if (tray === 1) total_price = 6;
            if (tray === 2) total_price = 8;
            if (tray === 3) total_price = 15;
            if (tray === 4) total_price = 17;
            total_price = total_price * num.value;
            break;
        case "きゅうり":
            if (tray === 1) total_price = 7;
            if (tray === 2) total_price = 9;
            if (tray === 3) total_price = 14;
            if (tray === 4) total_price = 16;
            total_price = total_price * num.value;
    }
    price.value = "¥" + Number(total_price).toLocaleString();
    hidden_price.value = total_price;
};

// 決定ボタンのホバー効果
var submitMouseover = function () {
    var button = document.getElementById("button");
    if (hover) {
        button.style.color = 'white';
        button.style.borderColor = '#20E233';
        button.style.backgroundColor = '#20E233';
        button.style.boxShadow = '#333333 0 1px 6px';
        button.disabled = false;
    }
};

// 決定ボタンのホバーアウト効果
var submitMouseout = function () {
    var button = document.getElementById("button");
    if (hover) {
        button.style.color = '#20E233';
        button.style.borderColor = '#20E233';
        button.style.backgroundColor = 'white';
        button.style.boxShadow = 'none';
        button.disabled = false;
    }
};

// フォームに日付をセット
var setDateForm = function (dayToRaise) {
    var date = document.getElementById("date");
    var now = new Date();
    now.setDate(now.getDate() + Number(dayToRaise));
    date.value = [now.getFullYear(), ( "0"+(now.getMonth() + 1) ).slice(-2),
        ( "0"+(now.getDate()) ).slice(-2)].join('-');
    date.setAttribute("min", date.value);
    checkInput();
};

// 現在の日付を取得
var getDateNow = function () {
    var now = new Date();
    return now.getMonth() + 1;
};

/**
 * @return {number}
 */
var DaysIncrease = function () {

    var rootstock = document.orderDetail.selectGraft;
    var increase = 0;

    switch (rootstock.selectedIndex) {
        case 2:
            if (getDateNow() > 3 && getDateNow() < 9) {
                increase = 2;
            } else {
                increase = 5;
            }
            break;
        case 3:
            if (getDateNow() > 3 && getDateNow() < 9) {
                increase = 3;
            } else {
                increase = 4;
            }
            break;
        case 4:
            if (getDateNow() > 3 && getDateNow() < 9) {
                increase = 8;
            } else {
                increase = 6;
            }
            break;
        case 5:
            if (getDateNow() > 3 && getDateNow() < 9) {
                increase = 11;
            } else {
                increase = 10;
            }
            break;
    }

    return increase;
};

// 最短引き取り日の計算
var DayController = function () {
    var productName = document.getElementById("productName").innerHTML;
    var dayToRaise = 0;

    switch (productName) {
        case "レタス":
            if (getDateNow() > 3 && getDateNow() < 9) {
                dayToRaise = 24 + DaysIncrease();
            } else {
                dayToRaise = 29 + DaysIncrease();
            }
            setDateForm(dayToRaise);
            break;
        case "とまと":
            if (getDateNow() > 3 && getDateNow() < 9) {
                dayToRaise = 34 + DaysIncrease();
            } else {
                dayToRaise = 39 + DaysIncrease();
            }
            setDateForm(dayToRaise);
            break;
        case "きゅうり":
            if (getDateNow() > 3 && getDateNow() < 9) {
                dayToRaise = 31 + DaysIncrease();
            } else {
                dayToRaise = 35 + DaysIncrease();
            }
            setDateForm(dayToRaise);
            break;
    }
};
