<?php
    $ram = shell_exec('free -m | grep Mem | awk \'{print $3}\'');
    $ram = ($ram / 1000) * 100;
    $ram = intval($ram);
    echo $ram . "%";
?>