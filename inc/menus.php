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
            array('page' => 'demo3', 'text' => 'node', 'url' => 'demo.php'),
        	array('page' => 'demo3', 'text' => 'node', 'url' => 'demo.php'),
        	array('page' => 'demo4', 'text' => 'u_web', 'url' => 'demo.php?view=u_web'),
        ),
    ),
    'group_2' => array(
        'groupClass' => 'media',
        'title' => '域名',
        'selected' => true,
        'items' => array(
            array('page' => 'group2_item1', 'text' => 'demain/ustatus', 'url' => 'demo.php?view=demain_status'),
            array('page' => 'group2_item2', 'text' => 'demain', 'url' => 'demo.php?view=demain'),
            array('page' => 'group2_item3', 'text' => 'u_web', 'url' => 'demo.php?view=demain_u_web'),
        ),
    ),
    'group_3' => array(
        'groupClass' => 'comments',
        'title' => '配置',
        'selected' => true,
        'items' => array(
            array('page' => 'group3_item1', 'text' => 'setting', 'url' => 'demo.php?view=manage'),
            array('page' => 'group3_item2', 'text' => 'setting_uinfo', 'url' => 'demo.php?view=manage_uinfo'),
            array('page' => 'group3_item3', 'text' => 'setting_location', 'url' => 'demo.php?view=manage_locations'),
            array('page' => 'group3_item4', 'text' => 'setting_option', 'url' => 'demo.php?view=manage_options'),
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
        if ($pageName == $item['page']) {
            $menus[$key]['selected'] = true;
            break;
        }
    }
}
