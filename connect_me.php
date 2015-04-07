<?php
/*$con=mysql_connect('localhost','root','jitu');
if(!$con||!mysql_select_db('mportal'))
 {
  die('could notconnect'.mysql_error());
 }
echo'connected succesfully';
*/

if($con=mysqli_connect("localhost","root","g2mani","mportal"))
{
  echo '';
}
else
{
  die('could notconnect'.mysqli_error());
}
?>