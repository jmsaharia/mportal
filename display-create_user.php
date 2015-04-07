
<html>
<head>
	<title>View Create User</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT create_user_id,role_name,faculty_name FROM create_user cu,role r,faculty f WHERE cu.role_id = r.role_id AND cu.faculty_id = f.faculty_id ";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'>Create_user ID</td>
    <td style='background-color:#B0E0E6;width:200px;'>Role Name</td>
    <td style='background-color:#B0E0E6;width:200px;'>Faculty Name</td>
    </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['create_user_id'].'</td>';
	echo '<td>' . $row['role_id'] . '</td>';
	echo '<td>' . $row['faculty_id'] . '</td>';
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