<?php
require_once 'src/data/init.php';

setUserDataCookies(0, "", time() - 3600);

header("Location: /");
exit();
