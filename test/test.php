<?php
/*
 * Author : arch 
 * Email : yajin160305@gmail.com
 * File : test.php
 * CreateDate : 2016-12-05 16:31:47
 * */

class test {
    
}

include 'Template.php';
$tpl = new Template(array('php_turn'=>true, 'debug'=>true));
$tpl->assign('data', 'hello,world');
$tpl->assign('person', 'Master');
$tpl->assign('pai', 3.14);
$arr = array(1,2,3,4,"hat,hat,hat", 6);
$tpl->assign('b', $arr);
$tpl->show('member');

/* vim: set tabstop=4 set shiftwidth=4 */

