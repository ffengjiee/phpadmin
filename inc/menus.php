<?php
/**
 * 系统菜单
 * 支持的group css类：pages, media, comments, settings
 * created by lane
 * @2012-01-01
 */
$supportGroupClasses = array('pages', 'media', 'comments', 'settings');
$extendArr = array('selected' => 'on', 'on' => '收起', 'off' => '展开');

//菜单自定义
$menus = array(
    'group_1' => array(
        'groupClass' => 'pages',
        'title' => '主机',
        'selected' => true,
        'items' => array(
            array('page' => 'demo', 'text' => 'node', 'url' => 'demo.php'),
        	array('page' => 'node_ip', 'text' => 'node_ip', 'url' => 'demo.php?view=node_ip'),
        	array('page' => 'node_disk', 'text' => 'node_disk', 'url' => 'demo.php?view=node_disk'),
        	array('page' => 'node_status', 'text' => 'node_status', 'url' => 'demo.php?view=node_status'),
        	array('page' => 'node_hard', 'text' => 'node_hard', 'url' => 'demo.php?view=node_hard'),
        	array('page' => 'u_web', 'text' => 'u_web', 'url' => 'demo.php?view=u_web'),
        ),
    ),
    'group_2' => array(
        'groupClass' => 'media',
        'title' => '域名',
        'selected' => false,
        'items' => array(
        	array('page' => 'demain', 'text' => 'demain', 'url' => 'demo.php?view=demain'),
            array('page' => 'demain_status', 'text' => 'demain/ustatus', 'url' => 'demo.php?view=demain_status'),
          
            array('page' => 'demain_u_web', 'text' => 'u_web', 'url' => 'demo.php?view=demain_u_web'),
        ),
    ),
    'group_3' => array(
        'groupClass' => 'comments',
        'title' => '配置',
        'selected' => false,
        'items' => array(
            array('page' => 'manage', 'text' => 'setting', 'url' => 'demo.php?view=manage'),
            array('page' => 'manage_uinfo', 'text' => 'setting_uinfo', 'url' => 'demo.php?view=manage_uinfo'),
            array('page' => 'manage_locations', 'text' => 'setting_location', 'url' => 'demo.php?view=manage_locations'),
            array('page' => 'manage_options', 'text' => 'setting_option', 'url' => 'demo.php?view=manage_options'),
        ),
    ),
);

//用户管理，只有超级用户才有权限
if ($_SESSION[SESSIONUSER] == $config[SUPERUSER]) {
    $menus['group_userlist'] = array(
        'groupClass' => 'settings',
        'title' => '用户管理',
        'selected' => true,
        'items' => array(
            array('page' => 'userlist', 'text' => '用户列表', 'url' => 'user_list.php'),
            array('page' => 'useradd', 'text' => '添加用户', 'url' => 'user_add.php'),
        )
    );
}

//group extend check
foreach ($menus as $key => $group) {
    foreach ($group['items'] as $item) {
        if ($_GET['view'] == $item['page']) {
            $menus[$key]['selected'] = true;
            
            break;
        }
       // echo $key.'view='.$_GET['view'] .'text='.$item['text'].'<br>';
    }
}
