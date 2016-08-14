<?php
/**
 * Created by PhpStorm.
 * User: wing
 * Date: 16/8/3
 * Time: 下午11:15
 */

require_once 'response/response.php';
require_once 'db.php';
$page = isset($_GET['page']) ? $_GET['page']: 1;
$pageSize = isset($_GET['pagesize']) ? $_GET['pagesize']: 2;
$data = array();
if(!is_numeric($page) || !is_numeric($pageSize)){
    return Response::show(401,'数据不合法',$data,'xml');
}
$offset = ($page-1) * $pageSize;
$sql = 'select *from user limit ' . $offset . ',' . $pageSize;

try{
    $connect = Db::getInstance()->connect();
}catch(Exception $e){
    //$e->getMessage();
    return Response::show(402,'数据库链接失败');
}

$result = mysqli_query($connect,$sql);
while( $row = mysqli_fetch_assoc($result) ){
    $data[] = $row;
}
if($data){
    return Response::show(200,'数据获取成功',$data,'json');
}

