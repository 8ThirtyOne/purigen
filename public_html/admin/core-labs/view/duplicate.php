<?php

extract($data, EXTR_OVERWRITE);

$webhelper->CheckAdminLogin($PageCode, urlencode($PageUrl), true);

?>