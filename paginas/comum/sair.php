<?php
session_start();
session_destroy();
header('location: /vittaclinic2/index.php');
?>