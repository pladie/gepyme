<!DOCTYPE html>
<html>
<head>
<link href="./css/gepyme.css" rel="stylesheet" type="text/css">
</head>
<body class="body">
<table cellpadding="0" cellspacing="0" align="center">
	<tr>
		<td><img src="img/speech-bubble-1.png" width="64" height="64" alt=""></td>
		<td width="95%" id="langsel">
		<div  class="head">
			<?php
				include("lang/languages.php");
				$l=file_get_contents("lang.tmp");
				$i=0;
				while (list($key, $value) = each($languages))
				{
					if($i++)echo ' / ';
					$s="";
					if($l==$key)$s='class="head"';
						echo '<a '.$s.' target="_parent" href="lang.php?'.$key.'">'.$value.'</a>';
				}
			?>
		</div>
		</td>
	</tr>
</table></body></html>
