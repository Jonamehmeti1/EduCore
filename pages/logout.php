<?php
session_start();
session_destroy(); // Fshin të gjitha të dhënat e kyçjes
header("Location: login.php");
exit();