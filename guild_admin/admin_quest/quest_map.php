<!-- 18.8073630, 98.9558558 -->
<?php 
if(!empty($_GET['cate'])){
$map = $_GET['cate']; 
$array_date=explode(')',$map);
$msg1=$array_date[0];
$msg2=$array_date[1];

$key=str_replace("(","",$msg1);
$latlong = str_replace(" ", "", $key);
?>
<iframe width="100%" height="450px" style="border:0;" allowfullscreen="" loading="lazy"  src = "https://maps.google.com/maps?q=<?=$latlong?>&hl=th;z=14&amp;output=embed"></iframe>
<?php }?>