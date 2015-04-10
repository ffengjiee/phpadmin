<?php
$pageName = 'demo';

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";

if (!$_SESSION[SESSIONUSER]) {
	header('Content-type: text/html; charset=utf-8');
	die('您无权查看此页！');
}
/**----------------
 * controll logical code here
 */


/**----------------
 * config title, description, keywords
*/
$pageTitle = 'icdn';


/**----------------
 * render views
 * layout and views
*/
$layoutName = 'main';
$viewGroup = 'default';
$viewName = isset($_GET['view'])?$_GET['view']:'demo';

$layoutPath = "{$incPath}/views/layout/";
include_once "{$layoutPath}/{$layoutName}.php";
