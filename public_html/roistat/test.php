<?php
///strom-trade.ru/protected/modules/mail/models/form - emailCallback
/// 
echo $_SERVER['DOCUMENT_ROOT'];

if(isset($_GET['test'])) {
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
    die;
}