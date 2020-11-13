<?php
include "service/ignapi.php";
$main = new ignapi();

// service worker
$main->InsertData();
echo "service running";