<?php

function autoload($clase)
{
//    echo $clase."<br>";
    $url="".str_ireplace("\\","/",$clase.".php");
//    echo $url.'<br><br>';
    require_once ($url);
}
spl_autoload_register('autoload')
?>