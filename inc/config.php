<?php
/**
 * config file
 * created by lane
 * @2012-01-01
*/
$config = array(
    SITENAME => 'Easy-CDN后台管理系统',
    VERSION => '1.0',

    PREKEY4PASSWORD => 'padm_',
    SUPERUSER => 'admin',
    SUPERUSERPASSWORD => 'phpwebadmin',

    DBDRIVER => array(
        DBHOST => '127.0.0.1:3316',
        DBUSER => 'root',
        DBPASSWORD => '111111',
        DATABASE => 'phpwebadmin'
    ),
    TABLEPRE => array(
        FRONTEND => 'eshop_',
        BACKEND => 'adm_',
    ),
    NEEDDB => false,
);

if (isset($needDb) && true == $needDb) {
    $config[NEEDDB] = true;
}
