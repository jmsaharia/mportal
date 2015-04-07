
<html>
<head>
	<title>View Stream</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT * FROM stream";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr> <td style='background-color:#B0E0E6;'> Stream ID</td> <td style='background-color:#B0E0E6;'> Stream</td></tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['stream_id'] . '</td>';
	echo '<td>' . $row['stream_name'] . '</td>';
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