<?php
/**
 * Created by PhpStorm.
 * User: si
 * Date: 2018/4/8
 * Time: 16:06
 */

$servername = "127.0.0.1";
$username = "root";
$password = "root";
$database = "chatroom";
//创建连接
$db=mysqli_connect($servername,$username,$password);
// 检查连接
if (!$db) {
    die("连接错误: " . mysqli_connect_error());
}
//创建数据库
$sql = "CREATE DATABASE $database";
if (mysqli_query($db, $sql)) {
    echo "数据库".$database."创建成功</br>";
} else {
    echo "Error creating database: " . mysqli_error($db)."</br>";
    exit;
}
mysqli_close($db);
$db=mysqli_connect($servername,$username,$password,$database);
//设置编码
mysqli_query($db,"set names utf8");
mysqli_query($db,"set character_set_client=utf8");
mysqli_query($db,"set character_set_results=utf8");
//创建表
$sql = "CREATE TABLE roles (
    id INT(6)  AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL COMMENT '用户名',
    url VARCHAR(255) NOT NULL COMMENT '图片地址'
)";
if (mysqli_query($db, $sql)) {
    echo "数据表 roles 创建成功</br>";
} else {
    echo "创建数据表错误: " . mysqli_error($db)."</br>";
    exit;
}
$basedir='../img/avatars/';
$dir=opendir($basedir);
while ($f=readdir($dir)){
    if (is_file($basedir.$f)){
        $name=explode('.',$f)[0];
        $url="img/avatars/$f";
        $sql="insert into roles (name,url) VALUES('".$name."','".$url."')";
        if(!mysqli_query($db,$sql)){
            echo "数据插入失败". mysqli_error($db)."</br>";
        }
    }
}
mysqli_close($db);

