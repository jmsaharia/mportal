
<html>
<head>
	<title>View semester</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT * FROM semester";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='1' cellpadding='10'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr> <td style='background-color:#B0E0E6;'> Semester ID</td> <td style='background-color:#B0E0E6;width:150px;'> Semester</td></tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['semester_id'] . '</td>';
	echo '<td>' . $row['semester_name'] . '</td>';
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