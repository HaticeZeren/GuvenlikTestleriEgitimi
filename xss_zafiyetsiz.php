<!DOCTYPE HTML>  
<html>
<head>
<style>
</style>
</head>
<body>  
<?php
$name = $email = $gender = $comment =  "";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  if (!empty($_GET["name"])) {
     $name = test_input($_GET["name"]);
  }
  
  if (!empty($_GET["email"])) {
     $email = test_input($_GET["email"]);
  }
  if (!empty($_GET["comment"])) {
     $comment = test_input($_GET["comment"]);
  } 

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<div class="row"  style="padding:20px;">
    <div class="col-sm-4" style="border:5px solid red;padding:10px;">
	<h2>Stored Cross Site Scripting (XSS)</h2><br></br>
      <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
<table>
<tr>
 <td>İsim:</td><td> <input type="text" name="name"><br></br>
</td>
  

</tr>
<tr>
  <td>E-mail:</td><td> <input type="text" name="email"><br></br>
</td>
  

</tr>
<tr>
  <td>Mesaj:</td><td> <textarea name="comment" rows="5" cols="30"></textarea><br></br>
</td>
</tr>
<tr>
<td><input type="submit" name="Gönder" value="Submit"></td>
 </tr>
</table> 
</form>
<?php
echo "<h2>Çıktı:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $comment;
?>