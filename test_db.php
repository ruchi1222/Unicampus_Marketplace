<?php
$c=new mysqli('localhost','root','','unimart');
$r=$c->query('DESCRIBE user');
$cols=[];
while($row=$r->fetch_assoc()){$cols[]=$row['Field'];}
echo implode(',', $cols);
?>
