<?php
$strSQL = " SELECT DATE FROM counter LIMIT 0,1";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
if ($objResult["DATE"] != date("Y-m-d")) {
    //*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
    $strSQL = " INSERT INTO daily (DATE,NUM) SELECT '" . date('Y-m-d', strtotime("-1 day")) . "',COUNT(*) AS intYesterday FROM  counter WHERE 1 AND DATE = '" . date('Y-m-d', strtotime("-1 day")) . "'";
    mysqli_query($conn, $strSQL);

    //*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
    $strSQL = " DELETE FROM counter WHERE DATE != '" . date("Y-m-d") . "' ";
    mysqli_query($conn, $strSQL);
}

//*** Insert Counter ปัจจุบัน ***//
$strSQL = " INSERT INTO counter (DATE,IP) VALUES ('" . date("Y-m-d") . "','" . $_SERVER["REMOTE_ADDR"] . "') ";
mysqli_query($conn, $strSQL);

//******************** Get Counter ************************//

// Today //
$strSQL = " SELECT COUNT(DATE) AS CounterToday FROM counter WHERE DATE = '" . date("Y-m-d") . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
$strToday = $objResult["CounterToday"];

// Yesterday //
$strSQL = " SELECT NUM FROM daily WHERE DATE = '" . date('Y-m-d', strtotime("-1 day")) . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
$strYesterday = $objResult["NUM"];

// This Month //
$strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m') . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
$strThisMonth = $objResult["CountMonth"];

// Last Month //
$strSQL = " SELECT SUM(NUM) AS CountMonth FROM daily WHERE DATE_FORMAT(DATE,'%Y-%m')  = '" . date('Y-m', strtotime("-1 month")) . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
$strLastMonth = $objResult["CountMonth"];

// This Year //
$strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y') . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
$strThisYear = $objResult["CountYear"];

// Last Year //
$strSQL = " SELECT SUM(NUM) AS CountYear FROM daily WHERE DATE_FORMAT(DATE,'%Y')  = '" . date('Y', strtotime("-1 year")) . "' ";
$objQuery = mysqli_query($conn, $strSQL);
$objResult = mysqli_fetch_assoc($objQuery);
$strLastYear = $objResult["CountYear"];
?>
<table class="table table-bordered">
    <tr>
        <td colspan="2" class="text-center font-weight-bold">
            จำนวนผู้ใช้บริการนับจาก IP
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">วันนี้</td>
        <td>
            <?php echo number_format($strToday, 0); ?>
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">เมื่อวานนี้</td>
        <td>
            <?php echo number_format($strYesterday, 0); ?>
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">เดือนนี้</td>
        <td>
            <?php echo number_format($strThisMonth, 0); ?>
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">เดือนที่แล้ว</td>
        <td>
            <?php echo number_format($strLastMonth, 0); ?>
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">ปีนี้</td>
        <td>
            <?php echo number_format($strThisYear, 0); ?>
        </td>
    </tr>
    <tr>
        <td class="font-weight-bold">ปีที่แล้ว</td>
        <td>
            <?php echo number_format($strLastYear, 0); ?>
        </td>
    </tr>
</table>