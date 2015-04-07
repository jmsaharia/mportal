
<?php
function renderForm($semesterId, $semesterName, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Semester</title>
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
    <form action="semester.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Semester Entry Form</th>
        <tr>
            <td colspan="2">Semester Id</td>
            <td colspan="2"><input class="switch1" type="text" name="semester_id" value= "<?php echo $semesterId ?>" ></td>
            <td><input type="submit" value="Get Record" name="getsemester"></td>
        </tr>
        <tr>
            <td colspan="2">Semester</td>
            <td colspan="3"><input class="switch2" type="text" name="semester_name" value="<?php echo $semesterName ?>"></td>
        </tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertsemester"></td>
            <td><input type="submit" value="Update" name="updatesemester"></td>
            <td><input type="submit" value="Delete" name="deletesemester"></td>
            <td><input type="submit" value="Get All Record" name="getAllsemester"></td>
            </form>
            <form action="semester.php">
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
if(isset($_POST['getsemester']))
{
    $semesterId = $_POST['semester_id'];
    if (isset($semesterId) && is_numeric($semesterId) && $semesterId > 0)
    {
        $sql = "SELECT * FROM semester WHERE semester_id = $semesterId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $semesterId = $row['semester_id'];
            $semesterName = $row['semester_name'];
            renderForm($semesterId, $semesterName,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', $error);
        }
    }
    else
    {
        $error = "Please enter a valid semester id";
        renderForm('', '', $error);
    }
    
}
else if(isset($_POST['insertsemester']))
{
    $semesterId = $_POST['semester_id'];
    $semesterName = $_POST['semester_name'];
    if ((isset($semesterId) && is_numeric($semesterId) && $semesterId > 0) && (isset($semesterName) && $semesterName <= 20))
    {
        $sql = "INSERT INTO semester values( $semesterId ,'$semesterName')";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter semester id and semester";
        renderForm('','',$error);
    }
}
else if(isset($_POST['updatesemester']))
{
    $semesterId = $_POST['semester_id'];
    $semesterName = $_POST['semester_name'];
    if ((isset($semesterName) && $semesterName <= 50))
    {
        $sql = "UPDATE semester SET semester_name = '$semesterName' WHERE semester_id = '$semesterId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter semester";
        renderForm('','',$error);
    }
}
else if(isset($_POST['deletesemester']))
{
    $semesterId = $_POST['semester_id'];
    if (isset($semesterId) && is_numeric($semesterId) && $semesterId > 0)
    {
        $sql = "DELETE FROM semester WHERE semester_id = $semesterId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid semester id";
        renderForm('', '', $error);
    }
}
else if(isset($_POST['getAllsemester']))
{
    header('Location: display-semester.php');
}
else
{
    $sql ="SELECT MAX(semester_id) AS max_semester_id FROM semester";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $semesterId = $row['max_semester_id'] + 1;
    }
    renderForm($semesterId,'','');
}

?>

