
<html>
<head>
	<title>View Student</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT student_id,collage_name,student_name,student_address,student_mobile,student_email FROM student s,collage c WHERE s.collage_id = c.collage_id";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'>Student ID</td>
    <td style='background-color:#B0E0E6;width:200px;'>Collage Name</td>
    <td style='background-color:#B0E0E6;width:200px;'>Student Name</td>
    <td style='background-color:#B0E0E6;width:300px;'>Student Address</td>
    <td style='background-color:#B0E0E6;width:100px;'>Mobile</td>
    <td style='background-color:#B0E0E6;width:150px;'>E-mail</td>
    </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['student_id'].'</td>';
	echo '<td>' . $row['collage_name'] . '</td>';
	echo '<td>' . $row['student_name'] . '</td>';
        echo '<td>' . $row['student_address'] . '</td>';
        echo '<td>' . $row['student_mobile'] . '</td>';
        echo '<td>' . $row['student_email'] . '</td>';
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