
<html>
<head>
	<title>View Faculty</title>
</head>
<body>

<?php
    include "index.html";
    include 'connect_me.php';
    $sql ="SELECT * FROM faculty";
    $sql1 ="SELECT * FROM collage";
    $result = mysqli_query($con,$sql);
    $result1 = mysqli_query($con,$sql1);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr> <td style='background-color:#EE0000;'>Faculty ID</td> <td>Collage Name</td><td>Faculty Name</td> <td>Faculty Address</td> <td>Phone</td> <td>email</td> </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['faculty_id'] . '</td>';
	while($row1 = mysqli_fetch_array($result1))
	{
		if($row1['collage_id'] == $row['collage_id'] )
		echo '<td>' . $row1['collage_name'] . '</td>';
	}
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