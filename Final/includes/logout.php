<?php

//used for the logout button on the userlinks page, ends the session and redirects to the main index page
session_start();
session_destroy();
header('Location: ../index.php');
exit;

