<?php
$página_inicio = file_get_contents('http://sms.ideassms.com:8080/smp/servlet/SendTextMessage?msisdn=5591691802&smscid=Telcel&sender=27362&client_id=bnm3x&content=SE HAN DEPOSITADO 152 EN REGALOS PARA CONSUMIRSE EN');
echo $página_inicio;
?>