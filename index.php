<?php

$pageName = 'index';

/**----------------
 * include common files
 */
$incPath = dirname(__FILE__);
require_once "{$incPath}/inc/init.php";


/**----------------
 * controll logical code here
 */



/**----------------
 * render views
 * layout and views
*/
$layoutName = 'main';
$viewGroup = 'default';
$viewName = 'index';

$layoutPath = "{$incPath}/views/layout/";
include_once "{$layoutPath}/{$layoutName}.php";
