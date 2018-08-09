<?php
require_once 'db_enter.php';
session_destroy();
header('Location: register.php');