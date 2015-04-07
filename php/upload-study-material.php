<?php
function renderForm($error)
 {
?>

<?php 
 if ($error != '')
 {
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 ?>
<script>alert('<?php echo $error ?>');</script>

<?php
 }
include "home.php";
require 'connect_me.php';
$sql = "SELECT * FROM smt";
$result = mysqli_query($con,$sql);

?>
 <div class="position">
	
    <form action="upload-file.php" method="post" enctype="multipart/form-data" target="_blank">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Upload Study Material</th>
        <tr>
            <td colspan="3" style="width:200px;">Choose a title</td>
            <td><input type="text" name="sm_title">
        </tr>
        <tr>
            <td colspan="6"><input type="file" name="file" size="50" /></td>
        </tr>
        <tr>
            <td colspan=""><input type="submit" value="Upload" /></td>
            </form>
            <form action="display-study-material.php" method="post">
                <td colspan="3"><input type="submit" value="View All Uploaded File Path"></td>
            </form>    
        </tr>   
    </table>
</div>
<div id="footer">
		
</div>
</div>

</body>
</html>
<?php
}
renderForm('');
?>