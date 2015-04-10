<?php
/**
 * controller: login page
 * create by lane
 * @2012-01-01
 */
$pageName = 'login';
$needDb = true; //enable db

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";


/**----------------
 * controll logical code here
 */
//user login
if (isset($_POST['username']) && isset($_POST['password'])
    && !empty($_POST['username']) && !empty($_POST['password'])
) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    unset($_SESSION[auth_token]);
    $res = httpRequest('http://api.icdn.me:8001/auth-user/login','post',array('password'=>$password,'username'=>$username));
    var_dump($res);
    $res = json_decode($res, 1);
 
    if (!empty($res) && $res['auth_token'] != '') {
        $_SESSION[SESSIONUSER] = $username;
        $_SESSION[auth_token] = $res['auth_token'];
        header("Location: index.php");
        exit(0);
    }else {
        $errorMsg = '请检查用户名和密码是否输入正确！';
    }
}

/**----------------
 * config title, description, keywords
*/
$pageTitle = '通用网站后台系统 -php版';
$pageDescription = '通用网站后台系统(php版)，含超级管理员、普通管理员简单两级用户系统。它能方便地整合到企业网站中，网站自身的所有管理功能，需开发者在此通用网站后台的基础上扩展实现。';
$pageKeywords = '通用网站后台,网站后台系统,php版网站后台,简单两级用户系统';

/**----------------
 * render views
 * layout and views
*/
$layoutName = 'login';
$viewGroup = 'login';
$viewName = 'index';

$layoutPath = "{$incPath}/views/layout/";
include_once "{$layoutPath}/{$layoutName}.php";
