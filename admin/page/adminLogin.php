<?php
/**
*接收客户端提交的phone、pwd，执行查询，若都正确，则输出“登录成功”，更新最后一次登录时间；若有错误，则输出“用户名或密码有误”
*/
/* @$name = $_REQUEST['userName'] or die('userName required');
@$pwd = $_REQUEST['pwd'] or die('pwd required'); */
@$name = $_GET['userName'] or die('-1');
@$pwd = $_GET['pwd'] or die('-2');

require('../conn/conn.php');

$sql = "SELECT * FROM admins WHERE adminname='$name' AND pwd='$pwd'";
$result = mysqli_query($conn,$sql);
//DQL: false 或 结果集
if($result===false){ //SQL语法错误
	echo "<h3>查询失败！</h3>";
	echo "请检查SQL语法：$sql";
}else {	//SQL语法正确
	//试着抓取一行记录
	$row = mysqli_fetch_assoc($result);
	if($row===null){	//没有查询结果集
	/* 	echo "<h3>登录失败！</h3>"; */
	  echo '0';
		/* echo "用户名或密码错误"; */
	}else {	//查询到一行记录
		/* echo "<h3>登录成功！".$row['username']."</h3>"; */
		echo '2';
		echo $row['adminname'];
		//修改最后一次登录时间
		$now = time()*1000;
		$id = $row['Id'];
		$sql = "UPDATE admins SET lastLoginTime='$now' WHERE Id='$id'";
    $result = mysqli_query($conn,$sql);
		
    //此处省略了$result false/true的判断
   
	}
}
?>
