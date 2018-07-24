<?php

date_default_timezone_set('Asia/Jakarta');

session_set_cookie_params(3600,"/");
session_name('GETJOB'.date('Y'));
session_start();

error_reporting(1);

ini_set('memory_limit','1024m');
/*unset($_SESSION['user']);
unset($_SESSION['nama']);
unset($_SESSION['password']);*/


include_once 'inc/config.php';
include_once 'inc/class.php';

$C = new core();


$m = isset($_REQUEST['i']) ? $_REQUEST['i'] : '';
$a = isset($_REQUEST['a']) ? $_REQUEST['a'] : ''; 

$C->gf();

if(empty($a)){
    $t = file_get_contents('template/'.$theme_index);
}

//if(!isset($_COOKIES['lang'])){
	//setcookie('lang','ind',time() + (86400 * 365), "/");
//}

//cek apakah dia member yang sedang login
if(isset($_SESSION['worker_id_user'])){
    $t = file_get_contents('template/logged.html');
    $C->initLoginParam();
}

$GLOBALS['msg']     = $_SESSION['msg'];
$GLOBALS['error']   = $_SESSION['error'];
$_SESSION['msg']    = '';
$_SESSION['error']  = '';

$GLOBALS['REPLACE']['TITLE'] 			= 'Temukan Pekerjaan Terbaikmu | GetJob.Co.Id';
$GLOBALS['REPLACE']['DESCRIPTION']		= 'Mencari pekerjaan di daerah Anda menggunakan GetJob mesin pencari pekerjaan - cara terbaik untuk mencari pekerjaan. Menemukan pekerjaan yang sempurna di dekat Anda dan menerapkan dengan hanya 1 kali klik.';
$GLOBALS['REPLACE']['KEYWORD']			= 'Lowongan Pekerjaan, Mencari Pekerja, jobstreet, jobsdb, karirpad, jobindo';
$GLOBALS['REPLACE']['AUTHOR']			= 'Sparkish';
$GLOBALS['REPLACE']['COPYRIGHT']		= 'PT. Sparkish Kinosoft Technology';


ob_start();

if(is_file('mod/'.$xob[0].'/'.$xob[0].'.'.$xob[1].'.php')){
    include_once 'mod/'.$xob[0].'/'.$xob[0].'.'.$xob[1].'.php';
}else{
    include_once 'template/'.$theme_404;
}

$o =  ob_get_clean();


$C->r();

exit();