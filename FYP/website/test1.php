<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
    
</head>
<script language="javascript" src="http://127.0.0.1:8008/YOWOCloudRFIDReader.js">
    rfidreader.onResult(function(resultdata)
{
	switch(resultdata.FunctionID)
    {
    	
		case 14:
        document.getElementById("CloudReaderVer").value = resultdata.strData;
        break;
		case 7:
		document.getElementById("CardNo").value = resultdata.CardNo;
		if(resultdata.Result>0)
		{
            document.getElementById("DataRead").value = resultdata.strData;		
		}
		else
		{
			document.getElementById("DataRead").value = GetErrStr(resultdata.Result);
		}
		break;
		case 8:
		document.getElementById("CardNo").value = resultdata.CardNo;
		if(resultdata.Result>0)
		{
			alert("写入成功，写入16进制数据：" + resultdata.strData);
		}
		else
		{
			alert("写入失败，错误：" + GetErrStr(resultdata.Result));	
		}
		break;
    }
}
);
    
    
    </script>
<body>
    <form>
        <h1>station 1</h1>
    <input type="number">
        <input type="submit">
    </form>
</body>
</html>