<?php

function insert($table,$data)
{
    global $conn;       
    $fields=""; $values="";
    $i=1;
    foreach($data as $key=>$val)
    {
        if($i!=1) { $fields.=", "; $values.=", "; }
        $fields.="$key";
        $values.="'$val'";
        $i++;
    }
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        if($conn->query($sql)) { 
            $id = mysqli_insert_id($conn);
        return  $id ;
    } else {
        echo $sql;
 }
}

function update($table,$data,$where)
{
    global $conn;           
    $modifs="";
    $i=1;
    foreach($data as $key=>$val)
    {
        if($i!=1){ $modifs.=", "; }
        $modifs.=$key." = '".$val."'"; 
        $i++;
    }
    $sql = ("UPDATE $table SET $modifs WHERE $where");
    if($conn->query($sql)) { return true; } 
    else { die("SQL Error: <br>".$sql."<br>".$conn->error); return false; }
}

function delete($table, $where)
{
    global $conn;           
    $sql = "DELETE FROM $table WHERE $where";
    if($conn->query($sql)) { return true; } 
    else { die("SQL Error: <br>".$sql."<br>".$conn->error); return false; }
}


function flieDUpload($tmp,$froder,$type,$namefile,$status,$nameUpdate){


    if ($status == '') {
        return 0;
    }

    if ($status == 'insert') {

        $fileContent = file_get_contents($tmp);
        file_put_contents($froder.'/'.$namefile.'.'.$type, $fileContent);
        return 1;
    }

    if ($status == 'update') {
        
        $mantypu = explode(".",$nameUpdate);
        $typeup =  $mantypu[1];
        $namefileup =  $mantypu[0];
        @unlink($froder.'/'.$namefileup.'.'.$typeup);

        $fileContent = file_get_contents($tmp);
        file_put_contents($froder.'/'.$namefile.'.'.$type, $fileContent);

    }

    if ($status == 'delete') {
        $mantypu = explode(".",$nameUpdate);
        $typeup =  $mantypu[1];
        $namefileup =  $mantypu[0];

        @unlink($froder.'/'.$namefileup.'.'.$typeup);
    }





}



function status_show($data_status)
{
    if ($data_status == 'YES') {
        $data = 'เปิด';
    }
    if ($data_status == 'NO') {
        $data = 'ปิด';
    }
    return $data;
}

function str_time_diff($timestamp = null, $html = true, $days_before_full_date = 3)
{
    // เราจะหาค่า "ช่วงห่างของเวลาปัจจุบันกับเวลาที่กำหนด"
    // โดยเวลาปัจจุบันนั้นหาได้จากฟังก์ชั่น time()
    // ซึ่งเวลาที่กำหนดนั้นก็จะอยู่ในตัวแปร $timestamp
    // ซึ่งทั้งหมดจะมีหน่วยเป็นวินาที ซึ่งจะเก็บไว้ในตัวแปร $diff
    // แต่ก่อนอื่นเราต้องตรวจว่า $timestamp เป็นตัวเลขหรือไม่
    if (is_numeric($timestamp)) {
        // ถ้าใช่ ก็เอาไปลบกับเวลาปัจจุบันเลย
        $diff = time() - $timestamp;
    } else {
        // ถ้าไม่ ก็อนุมานว่ามันเป็นสตริง เช่น 2013-03-07 07:57:12
        // ลองเอาไปแปลงเป็นวินาทีด้วย strtotime() แล้วลบกับเวลาปัจจุบัน
        $diff = time() - strtotime($timestamp);
    }
    // หากความต่างของเวลาปัจจุบันกับ $timestamp เป็น 0
    if (!$diff) {
        $str = "เมื่อสักครู่";
    }
    // หากความต่างของเวลาปัจจุบันกับ $timestamp น้อยกว่า 1 นาที
    elseif ($diff < 60) {
        $str = "$diff วินาทีที่แล้ว";
    }
    // หากความต่างของเวลาปัจจุบันกับ $timestamp น้อยกว่า 1 ชั่วโมง
    elseif ($diff < 3600) {
        $str = (int)($diff / 60) . ' นาทีที่แล้ว';
    }
    // หากความต่างของเวลาปัจจุบันกับ $timestamp น้อยกว่า 1 วัน
    elseif ($diff < 86400) {
        $str = (int)($diff / 3600) . ' ชั่วโมงที่แล้ว';
    }
    // หากความต่างของเวลาปัจจุบันกับ $timestamp น้อยกว่าจำนวนวันที่กำหนดไว้
    // ในตัวแปร $days_before_full_date ที่เราจะใช้เป็นตัวบอกว่า
    // ควรจะแสดงวันที่เต็มเมื่อช่วงห่างเกินกี่วัน
    elseif ($diff < 86400 * $days_before_full_date) {
        $str = (int)($diff / 86400) . ' วันที่แล้ว';
    }
    // หากตัวแปร $html เป็นจริง
    // หรือตัวแปร $str ยังไม่ถูกสร้างขึ้น ซึ่งเป็นเพราะช่วงห่างไม่อยู่ในเงื่อนไขข้างต้นเลย
    if ($html || !isset($str)) {
        // ตัวแปรที่ใช้แสดงผลชื่อเดือนภาษาไทย
        static $months = array(
            // ให้ index เริ่มที่ 1
            1 => 'มกราคม',  'กุมภาพันธ์', 'มีนาคม',    'เมษายน',
            'พฤษภาคม', 'มิถุนายน',  'กรกฎาคม',  'สิงหาคม',
            'กันยายน',  'ตุลาคม',   'พฤศจิกายน', 'ธันวาคม'
        );
        // หาค่าส่วนต่างๆ ของวันที่ปัจจุบันที่ต้องการ ด้วย explode() สตริงที่สร้างจาก date()
        // สมมติ date('j n Y H:s') สร้างสตริงออกมาแบบนี้ '8 4 2013 04:29'
        // เมื่อ explode() สตริงดังกล่าวโดยมี "ช่องว่าง" เป็นตัวแบ่ง
        // ก็จะได้ array('8', '4', '2013', '04:29')
        // และเพราะ array ดังกล่าวเป็น indexed array
        // เราจึงสามารถแยกใส่ตัวแปรได้ด้วย list()
        list($day, $month, $year, $time) = explode(' ', date('j n Y H:s'));
        // ทำค.ศ.ให้เป็นพ.ศ.ด้วยการ +543
        $year += 543;
        // วันที่เต็ม ที่จะใช้แสดงแบบเต็ม หรือใช้ใน attribute title
        $full_str = "วันที่ $day $months[$month] $year เวลา $time";
        // หาก $str ยังไม่ได้ถูกสร้างขึ้น แสดงว่าเราต้องแสดงวันที่แบบเต็ม
        if (!isset($str)) {
            // ทำให้ $str มีค่าเดียวกันกับ $full_str
            $str = $full_str;
        }
    }
    // คืนค่ากลับไป
    return $str;
}

function DateThaiFull($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear เวลา $strHour:$strMinute น.";
}

function DateNormal($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    return "$strDay/$strMonth/$strYear เวลา $strHour:$strMinute:$strSeconds";
}

function main_active()
{
    return "menu-is-opening menu-open";
}
function sub_active()
{
    return "active";
}
function display_show()
{
    return "style=\"display:block\"";
}

function questname($q)
{
    $new_content = iconv_substr($q, 0, 50, 'UTF-8');
    return $new_content;
}

function questnameindex($q)
{
    $new_content = iconv_substr($q, 0, 20, 'UTF-8') . "...";
    return $new_content;
}

function Thweek()
{
    //วันภาษาไทย
    $ThDay = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์");
    //กำหนดคุณสมบัติ
    $week = date("w"); // ค่าวันในสัปดาห์ (0-6)


    return $ThDay[$week];
}
function DateTh($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("m", strtotime($strDate));
    $strDay = date("d", strtotime($strDate));
    return "$strDay/$strMonth/$strYear";
}

function Dateymd($strDate)
{
    $strYear = date("Y", strtotime($strDate));
    $strMonth = date("m", strtotime($strDate));
    $strDay = date("d", strtotime($strDate));
    return "$strYear-$strMonth-$strDay";
}

function addDayswithdate($date, $days)
{

    $date = strtotime("+" . $days . " days", strtotime($date));
    return  date("Y-m-d", $date);
}

function guildDate($strDate)
{
    $ThDay = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์");
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strWeek = date("w", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    return "เวลา $strHour:$strMinute วัน$ThDay[$strWeek] ที่ $strDay/$strMonth/$strYear";
}

function get_client_ip()
{
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP')) {
        $ipaddress = getenv('HTTP_CLIENT_IP');
    } else if (getenv('HTTP_X_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    } else if (getenv('HTTP_X_FORWARDED')) {
        $ipaddress = getenv('HTTP_X_FORWARDED');
    } else if (getenv('HTTP_FORWARDED_FOR')) {
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    } else if (getenv('HTTP_FORWARDED')) {
        $ipaddress = getenv('HTTP_FORWARDED');
    } else if (getenv('REMOTE_ADDR')) {
        $ipaddress = getenv('REMOTE_ADDR');
    } else {
        $ipaddress = 'UNKNOWN';
    }
    return $ipaddress;
}

function quest_sta($quest_status)
{
    switch ($quest_status) {
        case 'อยู่ระหว่างตามหานักผจญภัย':
            $icon_status = "<label class='p01'>อยู่ระหว่างตามหานักผจญภัย</label>";
            break;
        case 'นักผจญภัยรับภารกิจ':
            $icon_status = "<label class='p02'>นักผจญภัยรับภารกิจ</label>";
            break;
        case 'ส่งมอบภารกิจ':
            $icon_status = "<label class='p02'>ส่งมอบภารกิจ</label>";
            break;
    }
    return $icon_status;
}

function questnameIndex2($q)
{
    $new_content = iconv_substr($q, 0, 55, 'UTF-8');
    return $new_content;
}

// เข้ารหัสเพื่อเก็บในฐานข้อมูล
function encodedy($string, $key)
{
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $hash = '';
    $j = '';
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string, $i, 1));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, isset($j), 1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey), 16, 36));
    }
    return $hash;
}
// ถอดรหัสมาแสดงผลบนหน้าเว็บไซต์
function decodedy($string, $key)
{
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
    $hash = '';
    $j = '';
    for ($i = 0; $i < $strLen; $i += 2) {
        $ordStr = hexdec(base_convert(strrev(substr($string, $i, 2)), 36, 16));
        if ($j == $keyLen) {
            $j = 0;
        }
        $ordKey = ord(substr($key, isset($j), 1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
}
