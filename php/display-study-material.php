
<html>
<head>
	<title>View File Path</title>
</head>
<body>

<?php
    include "home.php";
    //require 'core.php';
    include 'connect_me.php';
    
    $roleid = getRoleId();
    //$sql = null;
    if($roleid == 1)
    {
        $sql ="SELECT S.sm_id, S.sm_name, S.sm_path, S.sm_title, F.faculty_name FROM study_material S,faculty F WHERE S.faculty_id = F.faculty_id";
    }
    if($roleid == 2)
    {
        $facultyId = getFacultyId();
        $sql ="SELECT S.sm_id, S.sm_name, S.sm_path, S.sm_title, F.faculty_name FROM study_material S,faculty F WHERE S.faculty_id = F.faculty_id AND F.faculty_id = '$facultyId'";
    }
    
    $result = mysqli_query($con,$sql);
    echo "<div class='position'>";
    echo "<table border='0' align='center' cellpadding='10' cellspacing='1' style='margin-top: 50px;'>";
    echo "<tr>
    <td style='background-color:#B0E0E6;'>ID</td>
    <td style='background-color:#B0E0E6;'>Title</td>
    <td style='background-color:#B0E0E6;'>File Name</td>
    <td style='background-color:#B0E0E6;'>Directory</td>
    <td style='background-color:#B0E0E6;'>Faculty Name</td>
    </tr>";
    while($row = mysqli_fetch_array($result))
    {	
	echo "<tr>";
	echo '<td>' . $row['sm_id'] . '</td>';
	echo '<td>' . $row['sm_title'] . '</td>';
        echo '<td><a href=' . $row['sm_path'] .' target="_blank">'.$row['sm_name'].'</a></td>';
        
	echo '<td>' . $row['sm_path'] .'</td>';                   //$extension = pathinfo($row['sm_name'], PATHINFO_EXTENSION);
        echo '<td>' . $row['faculty_name'] . '</td>';
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