<html>

<head>
 <title>My QR Code creator</title>
 <!-- The next few lines tells our browser not to cache the webpage, we want a new graphic displayed everytime -->
 <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
 <META HTTP-EQUIV="Expires" CONTENT="0">
 <meta http-equiv="cache-control" content="no-cache">
</head>
<body>
<center>
<h1>My QR Code Creator</h1>
<h3>Enter some text in the textbox and click Create<br/>Then scan the QR Code with a qr scanner to see the results</h3>
<!-- Display the form and prefill the form with existing data if found in the URL -->
<form method="post">
   Enter some text: <input name="mytext" type=text value="<?php $mytext; ?>">
   <input type="submit" value="Create" />

<?php 
if(isset($_POST['mytext'])){
	$mytext = trim($_POST["mytext"]);

if (empty($mytext)) 
{
   /* Nothing was typed in our textbox - Display a simple message to the user */
   echo "<br/>Type some text into the box and click on [Create] to generate a QR-Code blob";
}
else
{
   /* run the Linux command-line QR-Code generator to create our blob */

   /* build our command */
   $cmd = 'qrencode -s 10 "' . $mytext . '" -o myqrcode.png '; 
 
   /* have the system execute our command */
   $last_line =  system("{$cmd} 2>&1", $retval); 
   echo '<pre>';
  
   /* display the blob and the date/time */
   echo "<img id='mycode' src=myqrcode.png border=1><p id='timeof'>" . strftime('%c') . "</pre>";
}

}
?>
<input type="submit" name="reset" value="Reset" />
<?php
if(isset($_POST['reset'])){
   if(count($_POST) > 0){
      $_POST = array();
   }
   header("localhost/portfolio/QRExample/qr.php");
}
?>
</form>
<footer>
    <a href="../../links.php" style="margin-left: 2vw;">Back to projects page.</a>
</footer>
</center>
</body>
</html>
