<html>
<head>
	<title>View smt</title>
</head>
<body>

<?php
    include 'connect_me.php';
    inlude 'home.php';
    $sql ="SELECT * FROM smt";
    $result = mysqli_query($con,$sql);
    echo "<table border='1' cellpadding='10'>";
    echo "<tr> <td style='background-color:#B0E0E6;'> Study material</th> <td style='background-color:#B0E0E6;'> Name</th> </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['smt_id'] . '</td>';
	echo '<td>' . $row['smt_name'] . '</td>';
	echo "</tr>"; 
    } 
    echo "</table>";
?>
</body>
</html>	