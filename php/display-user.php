
<html>
<head>
	<title>View User</title>
</head>
<body>

<?php
    include "home.php";
    include 'connect_me.php';
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'>User ID</td>
    <td style='background-color:#B0E0E6;'>User Name</td>
    <td style='background-color:#B0E0E6;'>Password</td>
    <td style='background-color:#B0E0E6;width:200px;'>Role Name</td>";
    $role = getRoleId();
    if($role == 1)
    {
	echo "<td style='background-color:#B0E0E6;width:200px;'>Facult Name</td>
	</tr>";
	$sql ="SELECT u.user_id,user_name,password,u.role_id, role_name,faculty_name FROM user u,role r,faculty f WHERE u.role_id = r.role_id AND u.user_id = f.user_id";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array( $result ))
	{
		if($row['role_id'] == 2)
		{
			echo "<tr>";
			echo '<td>' . $row['user_id'].'</td>';
			echo '<td>' . $row['user_name'].'</td>';
			echo '<td>' . $row['password'].'</td>';
			echo '<td>' . $row['role_name'] . '</td>';
			echo '<td>' . $row['faculty_name'] . '</td>';
			echo "</tr>";
		}
	}
    }
    if($role == 2)
    {
	echo "<td style='background-color:#B0E0E6;width:200px;'>Student Name</td>
	</tr>";
		$sql ="SELECT u.user_id,user_name,password,u.role_id, role_name,student_name FROM user u,role r,student s WHERE u.role_id = r.role_id AND u.user_id = s.user_id";
		$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_array( $result ))
	{
		if($row['role_id'] == 3)
		{
			echo "<tr>";
			echo '<td>' . $row['user_id'].'</td>';
			echo '<td>' . $row['user_name'].'</td>';
			echo '<td>' . $row['password'].'</td>';
			echo '<td>' . $row['role_name'] . '</td>';
			echo '<td>' . $row['student_name'] . '</td>';
			echo "</tr>";
		}
	}
    }
    echo "</table>";
?>
</div>
<div id="footer">
		
</div>
</div>

</body>
</html>	