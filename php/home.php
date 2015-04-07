
<?php
$con=mysql_connect('localhost','root','g2mani');
mysql_select_db('mportal');

require 'core.php';
if(isset($_POST['login']))
{
    $unm=$_POST['user_name'];
    $psw=$_POST['password'];
    if(!empty($unm) && !empty($psw))
    {
	$query = "select * from user where user_name ='$unm' and password ='$psw'";
	if($query_run=mysql_query($query))
	{
	    $query_num_rows=mysql_num_rows($query_run);
	    if($query_num_rows==1)
            {
		$roleid = mysql_result($query_run ,0,'role_id');
	    }
	}
	echo $roleid;
        
	
	
	if($roleid == 3)
	{
	    $query1="SELECT role_id, s.student_name FROM user u, student s WHERE u.user_id= s.user_id and u.user_name='$unm' AND u.password='$psw'";
	    if($query_run1=mysql_query($query1))
	    {
	    $query_num_rows1=mysql_num_rows($query_run1);
            if($query_num_rows1==1)
            {
                $_SESSION['roleid']=mysql_result($query_run1 ,0,'role_id');
		$_SESSION['student']=mysql_result($query_run1 ,0,'student_name');
                header('Location: index.php');
            }
	    }
	}
        
	if($roleid ==2)
	{
	$query2="SELECT role_id, f.faculty_name FROM user u, faculty f WHERE u.user_id= f.user_id and u.user_name='$unm' AND u.password='$psw'";
	if($query_run2=mysql_query($query2))
	{
	    $query_num_rows2=mysql_num_rows($query_run2);
	    if($query_num_rows2==1)
            {
                $_SESSION['roleid']=mysql_result($query_run2 ,0,'role_id');
		$_SESSION['faculty']=mysql_result($query_run2 ,0,'faculty_name');
                header('Location: index.php');
            }
	}
	}
	if($roleid==1)
	{
	$query3 = "SELECT u.role_id , r.role_name FROM user u, role r where u.role_id = r.role_id and u.user_name='$unm' AND u.password='$psw'";
	if($query_run3=mysql_query($query3))
	{
	    $query_num_rows3=mysql_num_rows($query_run3);
	    if($query_num_rows3==1)
            {
                $_SESSION['roleid']=mysql_result($query_run3 ,0,'role_id');
		$_SESSION['role']=mysql_result($query_run3 ,0,'role_name');
                header('Location: index.php');
            }
	}
	}
	else
	{
	    // echo "<BR><BR>"."<B>Invalid username or password!</B>";
            echo "<script>alert('Invalid username or password!');</script>";
            header('Location: index.php');
	}
    }
    else
    {
       // echo "<BR><BR>"."<B>You must supply User name and Password.</B>";
       echo "<script>alert('You must supply User name and Password!');</script>";
       header('Location: index.php');
    }
}
?>
<html>
<head>
<title>m-portal</title>
<link rel="stylesheet" type="text/css" href="design1.css" />
</head>
<body>
    <div id="content">
    <div class="headline">
	<div style="float:left; margin-left:20px;">
	<img width="110" height="90" src="logo.gif" alt="index" style="border:0;margin-top:5px;" />
	</div>
	<div class="">
	   <span>Krishna Kanta Handique State Open University (m-portal)</span>
	</div>
	<?php
	if(loggedin())
	{
	?>
	<div style="padding-left:65%;padding-top: 45px;font-size:15px;color: #EE0000;">
	<?php    
	    echo "Welcome, ".getFacultyName().getStudentName()." (".getRole().")";
	?>
	</div>
	<?php
	}
	else
	{
	?>
	<div style="padding-left:65%;">
	    <form action="index.php" method="post">
		<input type="text" name="user_name">
		<input type="text" name="password">
		<input type="submit" name="login" value="Login">
	    </form>	
	</div>
	<?php
	}
	?>
    </div>
    <div id="header">
	<div id="headerTutorial">
	    <a class="header" href="index.php" target="">Home</a> |
	    <?php
	    $roleid = getRoleId();
	    if($roleid == 1)
	    {
	    ?>
            <a class="header" href="stream.php" target="">Stream</a> |
            <a class="header" href="programme.php" target="">Programme</a> |
            <a class="header" href="course.php" target="">Course</a> |
            <a class="header" href="subject.php" target="">Subject</a> |
	    <a class="header" href="semester.php" target="">Semester</a> |
	    <a class="header" href="faculty.php" target=""> Faculty</a> |
	    <a class="header" href="collage.php" target="">College</a> |
	    <?php
	    }
	    if($roleid == 2)
	    {
	    ?>
		<a class="header" href="student.php" target="">Student</a> |
		<a class="header" href="upload-study-material.php" target="">Study Material</a> |
		<a class="header" href="spscs.php" target="">Assign Study Material</a> |
	    <?php
	    }
	    if($roleid == 1 || $roleid == 2)
	    {
	    ?>
	    <a class="header" href="user.php" target="">User</a> |
	    <?php
	    }
	    if($roleid == 2 || $roleid == 3)
	    {
	    ?>
		<a class="header" href="display-programme.php" target="">Programme</a> |
		<a class="header" href="display-course.php" target="">Course</a> |
		<a class="header" href="display-subject.php" target="">Subject</a> |
		<a class="header" href="display-faculty.php" target=""> Faculty</a> |
		<a class="header" href="display-collage.php" target="">College</a> |
	    <?php
	    }
	    if($roleid == 1 || $roleid ==2 || $roleid ==3 )
	    {
	    ?>
	    <a class="header" style="padding-left:200px;" href="logout.php">Logout</a>
	    <?php
	    }
	    ?>
	
	</div>
	<div id=headerAbout>
            
	</div>
    </div>
 