<!doctype html>
<?php session_start();?>
<html>
<head>
<meta charset = "utf-8">
<title>订单详细信息</title>
</head>
<body>

<center>
<img src="/figs/train.jpeg"  />
</center>
<center>
<?php 
$username = $_SESSION["name"];
$bookid = $_GET["bookid"];
//echo $bookid;
echo "<H3>尊敬的乘客 $username ，您的订单 $bookid 的详细信息如下</H3>";
// $conn = pg_connect("host=localhost port=5432 dbname=train user=fenglv password=nopasswd");
$conn = pg_connect("host=localhost port=5432 dbname=train user=postgres password=postgres") or die('connection failed') ;
if (!$conn){
	echo "连接失败";
}
$get_book_info = <<<EOF
      SELECT * 
      FROM book
      WHERE b_id = $bookid;
EOF;
$ret = pg_query($conn, $get_book_info);
$row_num = pg_num_rows($ret);
//echo $row_num;
if ($row_num == 0){
	echo "网页错误";
}
$info = pg_fetch_row($ret);
//$num = count($info);
//echo $num;
// 获取出发和到达站的名字
$sd1  = $info[4];
$sd2  = $info[5];
$trainid = $info[2];
//echo $trainid;
//echo $sd1;
//echo $sd2;
$sdname1 = <<<EOF
      SELECT A_StationName 
      FROM A_TrainId
      WHERE A_StationNum = $sd1 
      AND A_TrainId = '$trainid';
EOF;
//echo $sd1;
//echo $trainid;

$ret = pg_query( $conn, $sdname1 );

if (!$ret){
	echo "执行失败";
}
$x = pg_num_rows($ret);
if(!$x){
	echo "错误";
}
//echo "hhhh $x      hhhh";
$station1 = pg_fetch_row($ret);
$station1name = $station1[0];
echo $station1name;
$sdname2 = <<<EOF
      SELECT A_StationName 
      FROM A_TrainId 
      WHERE A_StationNum = $sd2
      AND A_TrainId = '$trainid';
EOF;
//echo $sd2;
$ret = pg_query( $conn, $sdname2 );
if (!$ret){
	echo "执行失败";
}
$station2 = pg_fetch_row($ret);
$station2name = $station2[0];
echo $station2name;

$status = array ("normal"=>"未乘坐", "cancelled"=>"已取消", "past"=>"已乘坐");
$seat   = array("YZ"=>"硬座", "RZ"=>"软座", "YW1"=>"硬卧上", "YW2"=>"硬卧中", "YW3"=>"硬卧下", "RW1"=>"软卧上", "RW2"=>"软卧下");

$index_ofse = $info[6];
$index_ofst = $info[8];
echo "<table border = \"4\">
      <tr>
      <td>用户名</td>
      <td>用户ID</td>
      <td>订单号</td>
      <td>列车号</td>
      <td>日期</td>
      <td>出发</td>
      <td>到达</td>
      <td>类型</td>
      <td>票价</td>
      <td>状态</td>
      <td>是否取消</td>
      </tr>      
      <tr>
      <td>$username</td>
      <td>$info[1]</td>
      <td>$info[0]</td>
      <td>$info[2]</td>
      <td>$info[3]</td>
      <td>$station1name</td>
      <td>$station2name</td>
      <td>$seat[$index_ofse]</td>
      <td>$info[7]</td>
      <td>$status[$index_ofst]</td>";
if ($info[8] = "normal"){
	echo "<td><a href = \"cancel.php?bookid=$info[0]&trainid=$info[2]&num1=$info[4]&num2=$info[5]&date=$info[3]&type=$info[6]\">取消</a></td>";
}
else{
	echo "<td>不可取消</td>";
}
echo "</tr>";
echo "</table>";

pg_close($conn);
?>
</center>
</body>
</html>
