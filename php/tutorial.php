
<html>
<head>
	<title>Tutorial</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    if(isset($_POST['getTutorial']))
    {
    $streamId = $_POST['stream_id'];
    $programmeId = $_POST['programme_id'];
    $courseId = $_POST['course_id'];
    $subjectId = $_POST['subject_id'];
    $semesterId = $_POST['semester_id'];
     if ((isset($streamId) && is_numeric($streamId) && $streamId> 0) &&
	(isset($programmeId) && is_numeric($programmeId) && $programmeId > 0) &&
	(isset($subjectId) && is_numeric($subjectId) && $subjectId > 0) &&
	(isset($courseId) && is_numeric($courseId) && $courseId > 0) &&
	(isset($semesterId) && is_numeric($semesterId) && $semesterId > 0))
    {
    $sql ="SELECT S.sm_name, S.sm_path, S.sm_title FROM study_material S, spscs P WHERE S.sm_id = P.sm_id AND P.stream_id = $streamId AND P.programme_id = $programmeId AND P.course_id = $courseId AND P.subject_id = $subjectId AND P.semester_id = $semesterId ";
    
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;width:30px;'>Sl No.</td>
    <td style='background-color:#B0E0E6;width:auto;'>Tutorials</td>
    </tr>";
    $i = 1;
    while($row = mysqli_fetch_array($result))
    {	
	echo "<tr>";
        echo '<td>'.$i.'</td>';
        echo '<td style="width:auto;"><a href=' . $row['sm_path'] .' target="_blank">'.$row['sm_title'].'</a></td>';
	echo "</tr>";
        $i++;
    } 
    echo "</table>";
    }
    }
    else
    {
        $error = "Please enter spscs id and spscs";
        header('Location: index.php');
    }
?>
</div>
<div id="footer">
		
</div>
</div>

</body>
</html>	