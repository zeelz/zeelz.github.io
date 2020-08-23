<?php
$fh = fopen("date.txt", 'w');
fwrite($fh, $_POST['date']);
fclose($fh);