<?php
$input = file('fr_CA.po');
$output = fopen('ar.po','w');
$translation = file('translatedkeys.txt');
$index=0;
foreach($input as $line){
	if(preg_match('/^msgstr/',$line)){
		fputs($output, str_replace('msgid', 'msgstr', $translation[$index]));
		$index++;
	}
	else
		fputs($output, $line);
}
fclose($output);
?>