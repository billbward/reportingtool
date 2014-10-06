<?php

//----Turn on PHP Error Msgs by un-commenting 2 lines Below----\\

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

session_start();
if(isset($_SESSION['sl'])) {
    unset($_SESSION['sl']);
}
if(isset($_SESSION['error_os'])){
	unset($_SESSION['error_os']);
}
if(isset($_SESSION['error_cs'])){
	unset($_SESSION['error_cs']);
}
if(isset($_SESSION['report'])){
    unset($_SESSION['report']);
}

session_write_close();


header("Location: home.php");

//----Backup to header----\\

/*$url = "home.php";

function redirect($url)
{
    if (!headers_sent())
    {    
        header("'Location: ".$url."'");
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}*/
?>
