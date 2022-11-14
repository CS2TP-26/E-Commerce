<?php
    $ram = shell_exec('free -m | grep Mem | awk \'{print $3}\'');
    $ram = ($ram / 7000) * 100;
    $ram = intval($ram);
    echo $ram . "%";
?>