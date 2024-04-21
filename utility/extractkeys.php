<?php
$output = fopen('keys.txt','w');
$translation = file('fr_CA.po');
foreach($translation as $line){
	if(preg_match('/^msgid/',$line))
		fputs($output, $line);
}
fclose($output);
?>