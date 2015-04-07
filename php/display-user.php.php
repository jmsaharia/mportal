
<html>
<head>
	<title>View User</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    $sql ="SELECT user_id,user_name,password,role_name,faculty_name FROM user u,role r,faculty f WHERE u.role_id = r.role_id AND u.faculty_id = f.faculty_id ";
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'>User ID</td>
    <td style='background-color:#B0E0E6;'>User Name</td>
    <td style='background-color:#B0E0E6;'>Password</td>
    <td style='background-color:#B0E0E6;width:200px;'>Role Name</td>
    <td style='background-color:#B0E0E6;width:200px;'>Faculty Name</td>
    </tr>";
    while($row = mysqli_fetch_array( $result ))
    {	
	echo "<tr>";
	echo '<td>' . $row['user_id'].'</td>';
	echo '<td>' . $row['user_name'].'</td>';
	echo '<td>' . $row['user_password].'</td>';
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