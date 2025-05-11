<?php
session_start();

session_destroy(); // Destroy all session data
header("location:../../index.php?msg=logout"); // Redirect to index page with logout message
