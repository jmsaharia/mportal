
<?php
function renderForm($create_userId, $roleId, $facultyId, $error)
 {
?>
<html>
<head>
    <title>create_user</title>
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
    <form action="create_user.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Create User Form</th>
        <tr>
            <td colspan="2">Create_User Id</td>
            <td colspan="2"><input class="switch1" type="text" name="create_user_id" value= "<?php echo $create_userId?>" ></td>
            <td><input type="submit" value="Get Record" name="getCreate_user_id"></td>
        </tr>
	<?php
	require 'connect_me.php';
	$sql = "SELECT * FROM role";
	$result = mysqli_query($con,$sql);
        ?>
	<tr>
            <td colspan="2">Role Name</td>
            <td colspan="3">
		<select name="role_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['role_id'] == $roleId)
			{
			?>
			<option value="<?php echo $row['role_id'];?>" selected><?php echo $row['role_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['role_id'];?>"><?php echo $row['role_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>



<?php

	require 'connect_me.php';
	$sql = "SELECT * FROM faculty";
	$result = mysqli_query($con,$sql);
        ?>
	<tr>
            <td colspan="2">Faculty Name</td>
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
            <td><input type="submit" value="Insert" name="insertCreate_user"></td>
            <td><input type="submit" value="Update" name="updateCreate_user"></td>
            <td><input type="submit" value="Delete" name="deleteCreate_user"></td>
            <td><input type="submit" value="Get All Record" name="getAllCreate_user"></td>
            </form>
            <form action="create_user.php">
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
if(isset($_POST['getCreate_user']))
{
    $create_userId = $_POST[create_user_id'];
    if (isset($create_userId) && is_numeric($create_userId) && $create_userId > 0)
    {
        $sql = "SELECT * FROM create_user WHERE create_user_id = $create_userId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $create_userId = $row['create_user_id'];
	    $roleId = $row['role_id'];
            $facultyId = $row['faculty_id'];
	    renderForm($create_userId, $roleId, $facultyId'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid create_user_id";
        renderForm('', '','', $error);
    }
    
}
else if(isset($_POST['insertCreate_user']))
{
    $create_userId = $_POST['create_user_id'];
    $roleId = $_POST['role_id'];
    $facultyId = $_POST['faculty_id'];
    
    
    if ((isset($create_userId) ))
    {
        $sql = "INSERT INTO create_user values($create_userId,$roleid,$facultyId)";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('','','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('','','',$error);
        }
    }
    else
    {
        $error = "Please enter create_user_id ";
        renderForm('','','',$error);
    }
}
else if(isset($_POST['updateCreate_user']))
{
    $create_userId = $_POST['create_user_id'];
    $roleId = $_POST['role_id'];
    $facultyId = $_POST['faculty_id'];
    if ((isset($create_userId) && (isset($roleId) &&(isset($facultyId))
    {
        $sql = "UPDATE create_user SET create_user = '$roleId', faculty_id = '$facultyId' WHERE create_user_id = '$create_userId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','','',$error);
        }
    }
    else
    {
        $error = "Please enter faculty";
        renderForm('','','',$error);
    }
}
else if(isset($_POST['deleteCreate_user']))
{
    $facultyId = $_POST['create_user_id'];
    if (isset($create_userId) && is_numeric($create_userId) && $create_userId > 0)
    {
        $sql = "DELETE FROM create_user WHERE create_user_id = $create_userId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('','','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('','','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid create_user id";
        renderForm('','','', $error);
    }
}
else if(isset($_POST['getAllCreate_user']))
{
    header('Location: display-create_user.php');
}
else
{
    $sql ="SELECT MAX(create_user_id) AS max_create_user_id FROM create_user";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $create_userId = $row['max_create_user_id'] + 1;
    }
    renderForm($create_user,'','','');
}

?>

