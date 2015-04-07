<?php
function renderForm($smId, $smName, $smPath, $smtId, $facultyId, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title> Study_material </title>
</head>
<body>
    
<?php 
 if ($error != '')
 {
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 ?>
<script>alert('<?php echo $error ?>');</script>
<?php
 }
 include "home.php";
 ?>
 <div class="position">
    <form action="study_material.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5"> Study_material</th>
        <tr>
            <td colspan="2">Study_material</td>
	    <td colspan="2"><input class="switch1" type="text" name="sm_id" value= "<?php echo $smId ?>" ></td>
            <td><input type="submit" value="Get Record" name="getStudy_material"></td>
        </tr>
       <tr>
            <td colspan="2">Study_material Name</td>
            <td colspan="3"><textarea class="switch3" name="sm_name"><?php echo $smName?></textarea></td>
        </tr>
        <tr>
            <td colspan="2">Study_material Path</td>
            <td colspan="3"><input class="switch3" type="text" name="sm_path" value="<?php echo $smPath ?>"></td>
        </tr>
	<?php
	require 'connect_me.php';
	$sql = "SELECT * FROM smt";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
            <td colspan="2">Study_material_type</td>
            <td colspan="3">
		<select name="smt_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['smt_id'] == $smtId)
			{
			?>
			<option value="<?php echo $row['smt_id'];?>" selected><?php echo $row['smt_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['smt_id'];?>"><?php echo $row['smt_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
        <?php
	$sql = "SELECT * FROM faculty";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
         <td colspan="2">Faculty</td>
            <td colspan="3">
		<select name="faculty_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['faculty_id'] == $facultyId)
			{
			?>
			<option value="<?php echo $row['faculty_id'];?>" selected><?php echo $row['faculty_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['faculty_id'];?>"><?php echo $row['faculty_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertStudy_material"></td>
            <td><input type="submit" value="Update" name="updateStudy_material"></td>
            <td><input type="submit" value="Delete" name="deleteStudy_material"></td>
            <td><input type="submit" value="Get All Record" name="getAllStudy_material"></td>
            </form>
            <form action="study_material.php">
                <td><input type="submit" value="Refresh"></td>
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
?>

<?php
require 'connect_me.php';
if(isset($_POST['getStudy_material']))
{
    $smId = $_POST['sm_id'];
    if(isset($smId) && is_numeric($smId) && $smId > 0)
    {
        $sql = "SELECT * FROM study_material WHERE sm_id = $smId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $smId = $row['sm_id'];
            $smName= $row['sm_name'];
            $smPath = $row['sm_path'];
            $smtId = $row['smt_id'];
            $facultyId = $row['faculty_id'];
            renderForm($smId, $smName, $smPath, $smtId, $facultyId, '');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', '', '', '',$error);
        }
    }
    else
    {
        $error = "Please enter a valid Study_material id";
        renderForm('', '', '', '', '', $error);
    }
    
}
else if(isset($_POST['insertStudy_material']))
{
    $smId = $_POST['sm_id'];
    $smName = mysql_real_escape_string(htmlspecialchars($_POST['sm_name']));
    $smPath = mysql_real_escape_string(htmlspecialchars($_POST['sm_path']));
    $smtId = $_POST['smt_id'];
    $facultyId = $_POST['faculty_id'];
       
    if ((isset($smId) && is_numeric($smId) && $smId > 0) &&
	(isset($smName) && $smName <= 50)&& 
        (isset($smPath) && $smPath <= 50)&&
        (isset($smtId) && is_numeric($smtId) && $smtId> 0) &&
	(isset($facultyId) && is_numeric($facultyId) && $facultyId > 0))
	
    {
        $sql = "INSERT INTO study_material values( $smId, '$smName','$smPath',$smtId, $facultyId )";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('', '', '', '', '',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('', '', '', '', '',$error);
        }
    }
    else
    {
        $error = "Please enter sm id and study_material name";
        renderForm('', '', '', '', '',$error);
    }
}
else if(isset($_POST['updateStudy_material']))
{
    $smId = $_POST['sm_id'];
    $smName = mysql_real_escape_string(htmlspecialchars($_POST['sm_name']));
    $smPath = mysql_real_escape_string(htmlspecialchars($_POST['sm_path']));
    if ((isset($smName) && $smName <= 50)&& (isset($smPath) && $smPath <= 50))
    {
        $sql = "UPDATE study_material SET sm_name = '$smName',sm_path = '$smPath' WHERE sm_id = '$smId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','','','','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','','','','',$error);
        }
    }
    else
    {
        $error = "Please enter Study_material";
        renderForm('','','','','',$error);
    
    $smtId = $_POST['smt_id'];
    $facultyId = $_POST['faculty_id'];
    
    }
}
else if(isset($_POST['deleteStudy_material']))
{
    $smId = $_POST['sm_id'];
    $smName = $_POST['sm_name'];
    $smPath = $_POST['sm_path'];
    $smtId = $_POST['smt_id'];
    $facultyId = $_POST['faculty_id'];
    if (isset($smId) && is_numeric($smId) && $smId > 0)
    {
        $sql = "DELETE FROM study_material WHERE sm_id = $smId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('', '', '', '', '',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('', '', '', '', '',$error);
        }
    }
    else
    {
        $error = "Please enter a valid sm id";
        renderForm('', '', '', '', '', $error);
    }
}
else if(isset($_POST['getAllStudy_material']))
{
    header('Location: display-study-material.php');
}
else
{
    $sql ="SELECT MAX(sm_id) AS max_sm_id FROM study_material";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $smId = $row['max_sm_id'] + 1;
    }
    renderForm($smId,'', '', '', '', '');
}
?>