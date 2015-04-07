
<html>
<head>
	<title>View Faculty</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT faculty_id,collage_name,faculty_name,faculty_address,phone,email FROM faculty f,collage c WHERE f.collage_id = c.collage_id";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'>Faculty ID</td>
    <td style='background-color:#B0E0E6;width:200px;'>Collage Name</td>
    <td style='background-color:#B0E0E6;width:200px;'>Faculty Name</td>
    <td style='background-color:#B0E0E6;width:300px;'>Faculty Address</td>
    <td style='background-color:#B0E0E6;width:100px;'>Phone</td>
    <td style='background-color:#B0E0E6;width:150px;'>email</td>
    </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['faculty_id'].'</td>';
	echo '<td>' . $row['collage_name'] . '</td>';
	echo '<td>' . $row['faculty_name'] . '</td>';
        echo '<td>' . $row['faculty_address'] . '</td>';
        echo '<td>' . $row['phone'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
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