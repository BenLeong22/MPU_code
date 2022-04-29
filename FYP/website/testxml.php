<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
$xml =simplexml_load_file("https://www.smg.gov.mo/smg/xml/specInfo.xml");
$xml =$xml;
$message =(String)$xml->Custom->SpecialInfoReport->TTS->English;
echo $message;
?>
</body>
</html>