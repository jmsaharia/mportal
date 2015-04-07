
<?php

function renderFrom ($create-userId, $roleID, $facultyId)
{
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>create-user</title>
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
    <form action="create-user.php" method= "post" >
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Create User Form</th>
        <tr>
            <td colspan="2">create-user Id</td>
            <td colspan="2"><input class="switch1" type="text" name="create-user_id" value= "<?php echo $create-userId?>" ></td>
            <td><input type="submit" value="Get Record" name="getCreate-user_id"></td>
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
			<option value="<?php echo $row['role_id'];?>" selected> <?php echo $row['role_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['role_id'];?>"> <?php echo $row['role_name']; ?></option>
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
			<option value="<?php echo $row['faculty_id'];?>" selected> <?php echo $row['faculty_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['faculty_id'];?>"> <?php echo $row['faculty_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
	
	
	
	
	
        

        <tr>
            <td><input type="submit" value="Insert" name="insertCreate-user"></td>
            <td><input type="submit" value="Update" name="updateCreate-user"></td>
            <td><input type="submit" value="Delete" name="deleteCreate-user"></td>
            <td><input type="submit" value="Get All Record" name="getAllCreate-user"></td>
            </form>
            <form action="create-user.php">
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
if(isset($_POST['getCreate-user']))
{
    $create-userId = $_POST['create-user_id'];
    if (isset($create-userId) && is_numeric($create-userId) && $create-userId > 0)
    {
        $sql = "SELECT * FROM create-user WHERE create-user_id = $create-userId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $create-userId = $row['create-user_id'];
	    $roleId = $row['role_id'];
            $facultyId = $row['faculty_id'];
	    renderForm($create-userId, $roleId, $facultyId'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid create-user_id";
        renderForm('', '','', $error);
    }
    
}
else if(isset($_POST['insertCreate-user']))
{
    $create-userId = $_POST['create-user_id'];
    $roleId = $_POST['role_id'];
    $facultyId = $_POST['faculty_id'];
    
    
    if ((isset($facultyId) ))
    {
        $sql = "INSERT INTO faculty values($create-userId,$roleid,$facultyId,)";
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
        $error = "Please enter create-user_id ";
        renderForm('','','',$error);
    }
}
else if(isset($_POST['updateCreate-user']))
{
    $create-userId = $_POST['create-user_id'];
    $roleId = $_POST['role_id'];
    $facultyId = $_POST['faculty_id'];
    if ((isset($create-userId) && (isset($roleId) &&(isset($facultyId))
    {
        $sql = "UPDATE create-user SET role_id = '$roleId', faculty_id = '$facultyId' WHERE create-user_id = '$create-userId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record up  dated successfully";
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
else if(isset($_POST['deleteCreate-user']))
{
    $facultyId = $_POST['create-user_id'];
    if (isset($create-userId) && is_numeric($create-userId) && $create-userId > 0)
    {
        $sql = "DELETE FROM create-user WHERE create-user_id = $create-userId";
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
        $error = "Please enter a valid create-user id";
        renderForm('','','', $error);
    }
}
else if(isset($_POST['getAllCreate-user']))
{
    header('Location: display-create-user.php');
}
else
{
    $sql ="SELECT MAX(create-user_id) AS max_create-user_id FROM faculty";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $create-userId = $row['max_create-user'] + 1;
    }
    renderForm($create-user,'','','');
}

?>

