<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="jquery/jquery.mobile-1.4.2.css">
	<link rel="stylesheet" href="jquery/jquery.mobile-1.4.2.min.css">
	<link rel="shortcut icon" href="../favicon.ico">
	    <script src="jquery/jquery.mobile-1.4.2.js"></script>
	    <script src="jquery/jquery.mobile-1.4.2.min.js"></script>
	    <script src="jquery/index.js"></script>
	    <script src="jquery/jqm-demos.js"></script>
</head>
<body bgcolor="#006699">

<?php
function renderForm($courseId, $courseName, $error)
{
?>
   
<?php 
 if ($error != '')
 {
 ?>
<script>alert('<?php echo $error ?>');</script>
<?php
 }
include "home.php";
 ?>
 
 	<div data-role="header" class="jqm-header">
		<p><span class="jqm-version"></span></p>
		<a href="menu.html" class="jqm-navmenu-link ui-btn ui-btn-icon-notext ui-corner-all ui-icon-bars ui-nodisc-icon ui-alt-icon ui-btn-left">Menu</a>
		</div>
        <div role="main" class="ui-content jqm-content">
		<center>  
		<table width="100%">
			<tr>
				<td><center><h2><font color="white">KKHSOU (m-Portal)</h2></center></td>
			</tr>
		</table>
    <form action="course.php" method="post">
	<br>
	<label for="course-id" class="ui-hidden-accessible">Course ID: </label>
	    <div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
		<input id="course-id" name="course-id" type="search" value=""  placeholder="Course ID" data-mini="true">
		<a href="#" class="ui-input-clear ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all ui-input-clear-hidden" title="Clear text">Clear text</a>
	    </div>
	<label for="course-name" class="ui-hidden-accessible">Course Name: </label>
	    <div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset ui-input-has-clear">
		<input id="course-name"  name="course-name" value = "" type="text"  placeholder="Course Name" data-mini="true">
		<a href="#" class="ui-input-clear ui-btn ui-icon-delete ui-btn-icon-notext ui-corner-all ui-input-clear-hidden" title="Clear text">Clear text</a>
            </div>
        <button class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star" name="insertCourse">Get Record</button>
        <button class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star" name="insertCourse">Insert</button>  
        <button class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star" name="updateCourse">Update</button>
        <button class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star" name="deleteCourse">Delete</button>
        <button class="ui-shadow ui-btn ui-corner-all ui-btn-icon-left ui-icon-star" name="getAllCourse">Get All Record</button>

	</form>
  
              <form action="course.php">
                <button class="ui-shadow ui-btn ui-corner-all">Refresh</button>
            </form>  

</div>
<div id="footer">
		
</div>


</body>
</html>
<?php
}
?>

<?php
require 'connect_me.php';
if(isset($_POST['getCourse']))
{
    $courseId = $_POST['course_id'];
    if (isset($courseId) && is_numeric($courseId) && $courseId > 0)
    {
        $sql = "SELECT * FROM course WHERE course_id = $courseId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $courseId = $row['course_id'];
            $courseName = $row['course_name'];
            renderForm($courseId, $courseName,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', $error);
        }
    }
    else
    {
        $error = "Please enter a valid Course id";
        renderForm('', '', $error);
    }
    
}
else if(isset($_POST['insertCourse']))
{
    $courseId = $_POST['course_id'];
    $courseName = $_POST['course_name'];
    if ((isset($courseId) && is_numeric($courseId) && $courseId > 0) && (isset($courseName) && $courseName <= 20))
    {
        $sql = "INSERT INTO course values( $courseId ,'$courseName')";
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
        $error = "Please enter Course id and course";
        renderForm('','',$error);
    }
}
else if(isset($_POST['updateCourse']))
{
    $courseId = $_POST['course_id'];
    $courseName = $_POST['course_name'];
    if ((isset($courseName) && $courseName <= 50))
    {
        $sql = "UPDATE Course SET course_name = '$courseName' WHERE course_id = '$courseId'";
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
        $error = "Please enter Course";
        renderForm('','',$error);
    }
}
else if(isset($_POST['deleteCourse']))
{
    $courseId = $_POST['course_id'];
    if (isset($courseId) && is_numeric($courseId) && $courseId > 0)
    {
        $sql = "DELETE FROM course WHERE course_id = $courseId";
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
        $error = "Please enter a valid course id";
        renderForm('', '', $error);
    }
}
else if(isset($_POST['getAllCourse']))
{
    header('Location: display-course.php');
}
else
{
    $sql ="SELECT MAX(course_id) AS max_course_id FROM Course";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $courseId = $row['max_course_id'] + 1;
    }
    renderForm($courseId,'','');
}
?>
