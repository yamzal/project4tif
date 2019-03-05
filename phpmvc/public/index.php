<?php
if( !session_id() ) session_start();
//menuju file init yaitu memanggil seluruh file atau kelas mvc yang ada 
 require_once '../app/init.php';
 
//menjalankan kelas app
$app = new App;
?>