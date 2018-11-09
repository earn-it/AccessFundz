<?php
echo $timee = time();
echo date("d-m-Y h:i:s a",$timee);
echo"<br><br>";
echo $endtime =  strtotime(date('d-m-Y h:i:s a', strtotime("+1 days")));
echo date("d-m-Y h:i:s a",$endtime);
?>