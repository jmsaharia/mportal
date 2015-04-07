
<html>
<head>
	<title>View college</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT * FROM collage";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'> college ID</td>
    <td style='background-color:#B0E0E6;width:200px;'>College Name</td>
    <td style='background-color:#B0E0E6;width:300px;'> College Location</td>
    </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['collage_id'] . '</td>';
	echo '<td>' . $row['collage_name'] . '</td>';
    echo '<td>' . $row['collage_location'] . '</td>';
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