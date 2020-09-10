<?php
session_destroy();
session_start();
header('Location: login.php');
