<?php
/* ตัวอย่าง หัวข้อคอนเทน
ภาพรวม          หน้าหลัก/ภาพรวม/จัดการภาพรวม 
ด้วยการใช้ funciton topicName , topicName2, topicSecond ตามลำดับ
*/
function topicName($files)
{
    switch ($files) {
        case '':
            $file = 'ภาพรวม';
            break;
        case 'dashboard':
            $file = 'ภาพรวม';
            break;
        case 'category':
            $file = 'ประเภทสินค้า';
            break;
        case 'product':
            $file = 'สินค้า';
            break;
        case 'system':
            $file = 'ผู้ดูแลระบบ';
            break;
        case 'customer':
            $file = 'ผู้ใช้งาน';
            break;
        case 'blog_type':
            $file = 'ประเภทบทความ';
            break;
        case 'location':
            $file = 'ฐานข้อมูลจังหวัด';
            break;
        case 'contact':
            $file = 'ติดต่อเรา';
            break;
        case 'tags':
            $file = 'ป้ายกำกับ';
            break;
        case 'blog':
            $file = 'บทความ';
            break;
        case 'author':
            $file = 'ผู้แต่ง';
            break;
        case 'categories':
            $file = 'ประเภทของภารกิจ';
            break;
        case 'quest':
            $file = 'ภารกิจ';
            break;
        case 'setting':
            $file = 'ตั้งค่า';
            break;
        case 'ads':
            $file = 'โฆษณา';
            break;
        case 'adslider':
            $file = 'โฆษณาแบบใหญ่';
            break;
        case 'member':
            $file = 'สมาชิก';
            break;
        case 'pages':
            $file = 'Phase, Road Map&Tutorial';
            break;
        case 'About':
            $file = 'About Boukensha';
            break;
        case 'Rules':
            $file = 'Rules & Order';
            break;

        case 'hall':
            $file = 'บันทึกแห่งเกียรติยศ';
            break;
        case 'hall_left':
            $file = 'Origin Quest';
            break;
        case 'hall_right':
            $file = 'Hall of Fame';
            break;
        case 'banner':
            $file = 'โฆษณา';
            break;
    }
    return $file;
}

function topicName2($files2)
{
    $mn = $files2; // ชื่อไฟล์เริ่มต้น เช่น index.php?mn=dashboard&file=dash_list ค่าที่ได้คือ mn=dashboard
    $mn2 = $files2 . '_list'; // ไฟล์เริ่มต้นในโฟลเดอร์แรก เช่น admin_dashboard ไฟล์เริ่มต้น dah_list.php
    switch ($files2) {
        case '':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=dashboard&file=dashboard_list\">ภาพรวม</a></li>";
            break;
        case 'dashboard':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ภาพรวม</a></li>";
            break;

        case 'category':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ประเภทสินค้า</a></li>";
            break;
        case 'product':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">สินค้า</a></li>";
            break;
        case 'system':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ผู้ดูแลระบบ</a></li>";
            break;
        case 'customer':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ผู้ใช้งาน</a></li>";
            break;
        case 'blog_type':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ประเภทบทความ</a></li>";
            break;
        case 'location':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ฐานข้อมูลจังหวัด</a></li>";
            break;
        case 'contact':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ติดต่อเรา</a></li>";
            break;
        case 'tags':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ป้ายกำกับ</a></li>";
            break;
        case 'blog':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">บทความ</a></li>";
            break;
        case 'author':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ผู้แต่ง</a></li>";
            break;
        case 'categories':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ประเภทของภารกิจ</a></li>";
            break;
        case 'quest':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ภารกิจ</a></li>";
            break;
        case 'setting':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">ตั้งค่า</a></li>";
            break;
        case 'ads':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">โฆษณา</a></li>";
            break;
        case 'adslider':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">โฆษณาแบบใหญ่</a></li>";
            break;
        case 'member':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">สมาชิก</a></li>";
            break;
        case 'pages':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">Phase, Road Map&Tutorial</a></li>";
            break;
        case 'About':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">About Boukensha</a></li>";
            break;

        case 'Rules':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">Rules & Order</a></li>";
            break;

        case 'hall':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">บันทึกแห่งเกียรติยศ</a></li>";
            break;
        case 'hall_left':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">Origin Quest</a></li>";
            break;
        case 'hall_right':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">Hall of Famet</a></li>";
            break;

        case 'banner':
            $mn = "  <li class=\"breadcrumb-item\"><a href=\"?mn=$mn&file=$mn2\">โฆษณา</a></li>";
            break;
    }
    return $mn;
}

function topicSecond($topiclast)
{
    $file = $topiclast;
    switch ($file) {
        case '':
            $file = "<li class=\"breadcrumb-item active\">ภาพรวมทั้งหมด</li>";
            break;
        case 'dashboard_list':
            $file = "<li class=\"breadcrumb-item active\">ภาพรวมทั้งหมด</li>";
            break;

        case 'category_list':
            $file = "<li class=\"breadcrumb-item active\">รายการประเภทสินค้า</li>";
            break;
        case 'category_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มประเภทสินค้า</li>";
            break;
        case 'category_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดประเภทสินค้า</li>";
            break;
        case 'category_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขประเภทสินค้า</li>";
            break;
        case 'category_delete':
            $file = "<li class=\"breadcrumb-item active\">ลบประเภทสินค้า</li>";
            break;

        case 'product_list':
            $file = "<li class=\"breadcrumb-item active\">รายการสินค้า</li>";
            break;
        case 'product_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มสินค้า</li>";
            break;
        case 'product_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขสินค้า</li>";
            break;
        case 'product_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดสินค้า</li>";
            break;
        case 'product_delete':
            $file = "<li class=\"breadcrumb-item active\">ลบสินค้า</li>";
            break;

        case 'system_list':
            $file = "<li class=\"breadcrumb-item active\">รายการผู้ดูแลระบบ</li>";
            break;
        case 'system_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มผู้ดูแลระบบ</li>";
            break;
        case 'system_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขผู้ดูแลระบบ</li>";
            break;
        case 'system_change':
            $file = "<li class=\"breadcrumb-item active\">เปลี่ยนรหัสผ่าน</li>";
            break;
        case 'system_delete':
            $file = "<li class=\"breadcrumb-item active\">ลบผู้ดูแลระบบ</li>";
            break;

        case 'customer_list':
            $file = "<li class=\"breadcrumb-item active\">รายการผู้ใช้งาน</li>";
            break;
        case 'customer_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขผู้ใช้งาน</li>";
            break;
        case 'customer_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดผู้ใช้งาน</li>";
            break;

        case 'blog_type_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลประเภทบทความ</li>";
            break;
        case 'blog_type_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มประเภทบทความ</li>";
            break;
        case 'blog_type_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขประเภทบทความ</li>";
            break;
        case 'blog_type_delete':
            $file = "<li class=\"breadcrumb-item active\">ลบประเภทบทความ</li>";
            break;
        case 'blog_type_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดบทความ</li>";
            break;

        case 'provinces_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลจังหวัด</li>";
            break;
        case 'districts_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลอำเภอ(เขต)</li>";
            break;
        case 'subdistricts_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลตำบล(แขวง)</li>";
            break;

        case 'contact_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลการติดต่อเรา</li>";
            break;
        case 'contact_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดการติดต่อเรา</li>";
            break;

        case 'tags_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลป้ายกำกับ</li>";
            break;
        case 'tags_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดป้ายกำกับ</li>";
            break;
        case 'tags_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มป้ายกำกับ</li>";
            break;
        case 'tags_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขป้ายกำกับ</li>";
            break;

        case 'blog_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลบทความ</li>";
            break;
        case 'blog_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดบทความ</li>";
            break;
        case 'blog_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มบทความ</li>";
            break;
        case 'blog_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขบทความ</li>";
            break;

        case 'author_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลผู้แต่ง</li>";
            break;
        case 'author_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดผู้แต่ง</li>";
            break;
        case 'author_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มผู้แต่ง</li>";
            break;
        case 'author_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขผู้แต่ง</li>";
            break;

        case 'categories_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลภารกิจ</li>";
            break;
        case 'categories_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดภารกิจ</li>";
            break;
        case 'categories_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มภารกิจ</li>";
            break;
        case 'categories_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขภารกิจ</li>";
            break;

        case 'quest_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลภารกิจ</li>";
            break;
        case 'quest_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดภารกิจ</li>";
            break;
        case 'quest_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มภารกิจ</li>";
            break;
        case 'quest_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขภารกิจ</li>";
            break;

        case 'setting_list':
            $file = "<li class=\"breadcrumb-item active\">ตั้งค่าการใช้งาน</li>";
            break;

        case 'ads_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลโฆษณา</li>";
            break;
        case 'ads_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดโฆษณา</li>";
            break;
        case 'ads_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มโฆษณา</li>";
            break;
        case 'ads_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขโฆษณา</li>";
            break;

        case 'adslider_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลโฆษณาแบบใหญ่</li>";
            break;
        case 'adslider_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดโฆษณาแบบใหญ่</li>";
            break;
        case 'adslider_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มโฆษณาแบบใหญ่</li>";
            break;
        case 'adslider_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขโฆษณาแบบใหญ่</li>";
            break;

        case 'member_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลสมาชิก</li>";
            break;
        case 'member_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดสมาชิก</li>";
            break;
        case 'member_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มสมาชิก</li>";
            break;
        case 'member_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขสมาชิก</li>";
            break;

        case 'pages_list':
            $file = "<li class=\"breadcrumb-item active\">รายการหน้า</li>";
            break;
        case 'pages_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขหน้า</li>";
            break;
        case 'pages_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดหน้า</li>";
            break;
        case 'pages_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มหน้า</li>";
            break;

        case 'hall_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลบันทึกแห่งเกียรติยศ</li>";
            break;

        case 'hall_left_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูล Origin Quest</li>";
            break;
        case 'hall_left_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียด Origin Quest</li>";
            break;
        case 'hall_left_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่ม Origin Quest</li>";
            break;
        case 'hall_left_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไข Origin Quest</li>";
            break;

        case 'hall_right_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูล Hall of Fame</li>";
            break;
        case 'hall_right_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียด Hall of Fame</li>";
            break;
        case 'hall_right_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่ม Hall of Fame</li>";
            break;
        case 'hall_right_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไข Hall of Fame</li>";
            break;

        case 'banner_list':
            $file = "<li class=\"breadcrumb-item active\">ข้อมูลโฆษณา</li>";
            break;
        case 'banner_detail':
            $file = "<li class=\"breadcrumb-item active\">รายละเอียดโฆษณา</li>";
            break;
        case 'banner_add':
            $file = "<li class=\"breadcrumb-item active\">เพิ่มโฆษณา</li>";
            break;
        case 'banner_edit':
            $file = "<li class=\"breadcrumb-item active\">แก้ไขโฆษณา</li>";
            break;
    }
    return $file;
}
?>
<div class="col-sm-6">
    <h1><?= topicName($_GET['mn']) ?></h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> หน้าหลัก</a></li>
        <?php
        // ตรวจสอบไฟล์ที่นำเข้ามีอยู่จริงไหม ถ้าไม่มีไม่แสดงผล
        $file = 'admin_' . $_GET['mn'] . '/' . $_GET['file'] . '.php';
        if (file_exists($file) or ($_GET['mn'] == "" && $_GET['mn'] == "")) {
            echo topicName2($_GET['mn']);
            echo topicSecond($_GET['file']);
        }
        ?>
    </ol>
</div>