<?php
/**
 * Created by PhpStorm.
 * User: xuanxiebiji
 * Date: 2017/1/2
 * Time: 下午9:01
 */
$link = mysqli_connect(
    '127.0.0.1',  /* The host to connect to 连接MySQL地址 */
    'root',      /* The user to connect as 连接MySQL用户名 */
    '',         /* The password to use 连接MySQL密码 */
    'web_im');    /* The default database to query 连接数据库名称*/

if (!$link) {
    printf("Can't connect to MySQL Server. Errorcode: %s ", mysqli_connect_error());
    exit;
}


//只能用函数来判断是否连接成功
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}
$senderUid = (int)$_POST['sender_uid'];
$reciverUid = (int)$_POST['reciver_uid'];
$message = str_replace([' ', ','], '', $_POST['message']);
$time = time();
$sql = "insert into message values(NULL ,'{$reciverUid}','{$senderUid}','{$message}','{$time}','1')";
$result = mysqli_query($link, $sql);
$insertId = mysqli_insert_id($link);

if ($insertId) {
    $returnArr = [
        'status' => 1,
        'info' => $insertId,
    ];
} else {
    $returnArr = [
        'status' => 0,
        'info' => '',
    ];
}

echo json_encode($returnArr);
mysqli_close($link);
exit();

