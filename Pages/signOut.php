<?php
session_start();
require_once('../Libraries/AccountManagement.php');
AccountManagement::signout();
?>