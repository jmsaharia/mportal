
<html>
<head>
	<title>View spscs</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT spscs_id,stream_name,programme_name,course_name,subject_name,semester_name, sm_name,sm_title,sm_path FROM 
    spscs s, stream st, programme p, course c, subject sb, semester sm, study_material t WHERE s.stream_id = st.stream_id 
    AND s.programme_id = p.programme_id AND s.course_id = c.course_id AND s.subject_id = sb.subject_id 
    AND s.semester_id = sm.semester_id AND s.sm_id = t.sm_id";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'> Spscs ID</td>
    <td style='background-color:#B0E0E6;'> Stream</td>
    <td style='background-color:#B0E0E6;width:120px;'> Programme</td>
    <td style='background-color:#B0E0E6;width:150px;'>Coursce</td>
    <td style='background-color:#B0E0E6;width:200px;'> Subject</td>
    <td style='background-color:#B0E0E6;width:120px;'> Semester</td>
    <td style='background-color:#B0E0E6;width:210px;'> File Name</td>
    </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['spscs_id'] . '</td>';
	echo '<td>' . $row['stream_name'] . '</td>';
	echo '<td>' . $row['programme_name'] . '</td>';
	echo '<td>' . $row['course_name'] . '</td>';
	echo '<td>' . $row['subject_name'] . '</td>';
	echo '<td>' . $row['semester_name'] . '</td>';
	echo '<td><a href=' . $row['sm_path'] .' target="_blank">'.$row['sm_name'].'</a> ('.$row['sm_title'].')</td>';
        echo "</tr>"; 
    } 
    echo "</table>";
?>
</div>
<div id="footer">
		
</div>
</div>

</body>
</html>	