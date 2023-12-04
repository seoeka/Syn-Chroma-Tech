<?php

session_start();
session_destroy();

header("location:/Syn-Chroma-Tech/admin/login.php");
?>