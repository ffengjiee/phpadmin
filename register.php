<?php
/**
 * controller: login page
 * create by lane
 * @2012-01-01
 */
$pageName = 'login';
//$needDb = true; //enable db

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";


/**----------------
 * config title, description, keywords
*/
$pageTitle = 'icdn-后台管理';
$pageDescription = 'icdn-后台管理';
$pageKeywords = 'icdn';

/**----------------
 * render views
 * layout and views
*/
$layoutName = 'login';
$viewGroup = 'login';
$viewName = 'register';

$layoutPath = "{$incPath}/views/layout/";
include_once "{$layoutPath}/{$layoutName}.php";
