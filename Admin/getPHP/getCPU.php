<?php
$cpu = shell_exec('top -bn1 | grep "Cpu(s)" | awk \'{print $2 + $4}\'');
$cpu = intval($cpu);
echo $cpu . "%";
?>






