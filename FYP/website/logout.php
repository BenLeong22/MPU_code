<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>no tittle</title>
</head>
<body>
<?php session_start(); ?>
<?php 
	session_unset();
	echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>	
</body>
</html>