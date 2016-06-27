<?php

session_start();
unset ($SESSION['username']);
session_destroy();

header('Location: http://localhost:8079/phpLogin/login.html');

?>
