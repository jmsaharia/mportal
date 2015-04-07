<?php include 'home.php';  ?>
<html>
<head>
	<title>Index page</title>
</head>
<body>
    <div style="height:350px;">
        <div id="signup">
            <table border="0" width="100%" cellpadding="10">
                <form action="tutorial.php" method="post">
                <th colspan="5"><span style="color:darkseagreen;font-size:18px;">Find Tutorial</span></th>
                <?php
                require 'connect_me.php';
        	$sql = "SELECT * FROM stream";
        	$result = mysqli_query($con,$sql);
                ?>
                
                <tr>
                    <td colspan="2">Stream</td>
                    <td colspan="3">
        		<select name="stream_id" style="width:200px;">
        		    <option style='display:none;'>--Select--</option>
            		    <?php
        		    $i=1;
            		    while($row = mysqli_fetch_array($result))
        		     {
        			?>
        			<option value="<?php echo $row['stream_id'];?>"><?php echo $row['stream_name']; ?></option>
        			<?php
                                $i++;
        		     }
        		    ?>
        		</select>
        	    </td>
                </tr>
        	<?php
        	$sql = "SELECT * FROM programme";
        	$result = mysqli_query($con,$sql);
                ?>
                <tr>
                    <td colspan="2">Programme</td>
                    <td colspan="3">
        		<select name="programme_id" style="width:200px;">
        		  <option style='display:none;'>--Select--</option>
        		    <?php
        		    $i=1;
            		    while($row = mysqli_fetch_array($result))
        		     {
        			?>
        			<option value="<?php echo $row['programme_id'];?>"><?php echo $row['programme_name']; ?></option>
        			<?php
                                $i++;
        		     }
        		    ?>
        		</select>
        	    </td>
                </tr>
                <?php
        	$sql = "SELECT * FROM course";
        	$result = mysqli_query($con,$sql);
                ?>
                <tr>
                    <td colspan="2">Course</td>
                    <td colspan="3">
        		<select name="course_id" style="width:200px;">
        		    <option style='display:none;'>--Select--</option>
        		    <?php
        		    $i=1;
        		    while($row = mysqli_fetch_array($result))
        		     {
        			?>
        			<option value="<?php echo $row['course_id'];?>"><?php echo $row['course_name']; ?></option>
        			<?php
                                $i++;
        		     }
        		    ?>
        		</select>
        	    </td>
                </tr>
        	<?php
        	$sql = "SELECT * FROM subject";
        	$result = mysqli_query($con,$sql);
                ?>
                <tr>
                    <td colspan="2">Subject</td>
                    <td>
        		<select name="subject_id"  style="width:200px;">
        		    <option style='display:none;'>--Select--</option>
        		    <?php
        		    $i=1;
        		    while($row = mysqli_fetch_array($result))
        		     {
        			?>
        			<option value="<?php echo $row['subject_id'];?>"><?php echo $row['subject_name']; ?></option>
        			<?php
                                $i++;
        		     }
        		    ?>
        		</select>
        	    </td>
                </tr>
                <?php
        	$sql = "SELECT * FROM semester";
        	$result = mysqli_query($con,$sql);
                ?>
                <tr>
                    <td colspan="2">Semester</td>
                    <td colspan="3">
        		<select name="semester_id" style="width:200px;">
        		    <option style='display:none;'>--Select--</option>
        		    <?php
        		    $i=1;
        		    while($row = mysqli_fetch_array($result))
        		     {
        			?>
        			<option value="<?php echo $row['semester_id'];?>"><?php echo $row['semester_name']; ?></option>
        			<?php
                                $i++;
        		     }
        		    ?>
        		</select>
        	    </td>
                </tr>
                <tr>
                    <td colspan="5"><input style="margin-left: 38%;width:100px;" type="submit" value="Search" name="getTutorial"></td>
                </tr>    
            </form>
            </table>    
        </div>    
    </div>
    <div id="footer">
		
    </div>
</div>
</body>
</html>

