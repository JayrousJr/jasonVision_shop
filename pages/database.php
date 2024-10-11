<?php 
include('db_backup/db_backup_library.php');
$dbbackup = new db_backup;
$dbbackup->connect("localhost","root","","abel");
$dbbackup->backup();
$dbbackup->download();
 ?>