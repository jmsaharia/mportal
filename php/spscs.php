
<?php
function renderForm($spscsId, $streamId, $programmeId, $courseId, $subjectId, $semesterId, $smId, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title> spscs </title>
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
    <form action="spscs.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5"> Spscs Entry Form</th>
        <tr>
            <td colspan="2">Spscs</td>
	    <td colspan="2"><input class="switch1" type="text" name="spscs_id" value= "<?php echo $spscsId ?>" ></td>
            <td><input type="submit" value="Get Record" name="getSpscs"></td>
        </tr>
	
	<?php
	require 'connect_me.php';
	$sql = "SELECT * FROM stream";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
            <td colspan="2">Stream</td>
            <td colspan="3">
		<select name="stream_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['stream_id'] == $streamId)
			{
			?>
			<option value="<?php echo $row['stream_id'];?>" selected><?php echo $row['stream_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['stream_id'];?>"><?php echo $row['stream_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
	<?php
	$sql = "SELECT * FROM programme";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
            <td colspan="2">Programme</td>
            <td colspan="3">
		<select name="programme_id">
		  <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['programme_id'] == $programmeId)
			{
			?>
			<option value="<?php echo $row['programme_id'];?>" selected><?php echo $row['programme_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['programme_id'];?>"><?php echo $row['programme_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
        <?php
	$sql = "SELECT * FROM course";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
            <td colspan="2">Course</td>
            <td colspan="3">
		<select name="course_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['course_id'] == $courseId)
			{
			?>
			<option value="<?php echo $row['course_id'];?>" selected><?php echo $row['course_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['course_id'];?>"><?php echo $row['course_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
	<?php
	$sql = "SELECT * FROM subject";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
            <td colspan="2">Subject</td>
            <td colspan="3">
		<select name="subject_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['subject_id'] == $subjectId)
			{
			?>
			<option value="<?php echo $row['subject_id'];?>" selected><?php echo $row['subject_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['subject_id'];?>"><?php echo $row['subject_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
        <?php
	$sql = "SELECT * FROM semester";
	$result = mysqli_query($con,$sql);
        ?>
        <tr>
            <td colspan="2">Semester</td>
            <td colspan="3">
		<select name="semester_id">
		    <option style='display:none;'>--Select--</option>
		    <?php
		    $i=1;
		    while($row = mysqli_fetch_array($result))
		     {
			if($row['semester_id'] == $semesterId)
			{
			?>
			<option value="<?php echo $row['semester_id'];?>" selected><?php echo $row['semester_name']; ?></option>
			<?php
			}
			else
			{
			?>
			<option value="<?php echo $row['semester_id'];?>"><?php echo $row['semester_name']; ?></option>
			<?php
			}
		     $i++;
		     }
		    ?>
		</select>
	    </td>
        </tr>
	
	<tr>
	    <td colspan="2">Study Material</td>
	    <td colspan="3"> <input type="text" name="sm_id" value= "<?php echo $smId ?>" </td>
	</tr>
        <tr>
            <td><input type="submit" value="Insert" name="insertSpscs"></td>
            <td><input type="submit" value="Update" name="updateSpscs"></td>
            <td><input type="submit" value="Delete" name="deleteSpscs"></td>
            <td><input type="submit" value="Get All Record" name="getAllSpscs"></td>
            </form>
            <form action="spscs.php">
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

if(isset($_POST['getSpscs']))
{
    $spscsId = $_POST['spscs_id'];
    if(isset($spscsId) && is_numeric($spscsId) && $spscsId > 0)
    {
        $sql = "SELECT * FROM spscs WHERE spscs_id = $spscsId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $spscsId = $row['spscs_id'];
            $streamId = $row['stream_id'];
            $programmeId = $row['programme_id'];
            $subjectId = $row['subject_id'];
            $courseId = $row['course_id'];
            $semesterId = $row['semester_id'];
	    $smId = $row['sm_id'];

            renderForm($spscsId, $streamId ,$programmeId,$courseId,$subjectId,$semesterId,$smId, '');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', '', '', '', '','',$error);
        }
    }
    else
    {
      
        $error = "Please enter a valid spscs id";
        renderForm('', '', '', '', '', '','', $error);
    }
    
}
else if(isset($_POST['insertSpscs']))
{
    $spscsId = $_POST['spscs_id'];
    $streamId = $_POST['stream_id'];
    $programmeId = $_POST['programme_id'];
    $subjectId = $_POST['subject_id'];
    $courseId = $_POST['course_id'];
    $semesterId = $_POST['semester_id'];
    $smId = $_POST['sm_id'];
    
    if ((isset($spscsId) && is_numeric($spscsId) && $spscsId > 0) &&
	(isset($streamId) && is_numeric($streamId) && $streamId> 0) &&
	(isset($programmeId) && is_numeric($programmeId) && $programmeId > 0) &&
	(isset($subjectId) && is_numeric($subjectId) && $subjectId > 0) &&
	(isset($courseId) && is_numeric($courseId) && $courseId > 0) &&
	(isset($semesterId) && is_numeric($semesterId) && $semesterId > 0) &&
	(isset($smId) && is_numeric($smId) && $smId > 0))
    {
        $sql = "INSERT INTO spscs values( $spscsId, $streamId,$programmeId,$courseId,$subjectId,$semesterId,$smId )";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('', '', '', '', '', '','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('', '', '', '', '', '','',$error);
        }
    }
    else
    {
        $error = "Please enter spscs id and spscs";
        renderForm('', '', '', '', '', '','',$error);
    }
}
else if(isset($_POST['updateSpscs']))
{
    $spscsId = $_POST['spscs_id'];
    $streamId = $_POST['stream_id'];
    $programmeId = $_POST['programme_id'];
    $subjectId = $_POST['subject_id'];
    $courseId = $_POST['course_id'];
    $semesterId = $_POST['semester_id'];
    $smId = $_POST['sm_id'];
    if (isset($spscsId) && isset($streamId) && isset($programmeId) && isset($subjectId) && isset($courseId) && isset($semesterId) && isset($smId))
    {
        $sql = "UPDATE spscs SET stream_id = $streamId, programme_id = $programmeId, course_id = $courseId, subject_id = $subjectId, semester_id = $semesterId,sm_id = $smId  WHERE spscs_id = $spscsId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','','','','','','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','','','','','','',$error);
        }
    }
    else
    {
        $error = "Please fill the form";
        renderForm('','','','','','','',$error);
    }
}
else if(isset($_POST['deleteSpscs']))
{
    $spscsId = $_POST['spscs_id'];
    $streamId = $_POST['stream_id'];
    $programmeId = $_POST['programme_id'];
    $subjectId = $_POST['subject_id'];
    $courseId = $_POST['course_id'];
    $semesterId = $_POST['semester_id'];
    if (isset($spscsId) && is_numeric($spscsId) && $spscsId > 0)
    {
        $sql = "DELETE FROM spscs WHERE spscs_id = $spscsId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('', '', '', '', '', '','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('', '', '', '', '', '','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid spscs id";
        renderForm('', '', '', '', '', '','', $error);
    }
}
else if(isset($_POST['getAllSpscs']))
{
    header('Location: display-spscs.php');
}
else
{
    $sql ="SELECT MAX(spscs_id) AS max_spscs_id FROM spscs";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $spscsId = $row['max_spscs_id'] + 1;
    }
    renderForm($spscsId,'', '', '', '', '', '','');
}

?>