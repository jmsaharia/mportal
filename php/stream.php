
<?php
function renderForm($streamId, $streamName, $error)
 {
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title>Stream</title>
</head>
<body>
    
<?php 
 if ($error != '')
 {
 //echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 ?>
<script>alert('<?php echo $error ?>');</script>
<?php
 }
include "home.php";
 ?>
 <div class="position">
	
    <form action="stream.php" method="post">
    <table border='0' align='center' cellpadding="10" cellspacing="1" style="margin-top: 50px;">
        <th colspan="5">Stream Entry Form</th>
        <tr>
            <td colspan="2">Stream Id</td>
            <td colspan="2"><input class="switch1" type="text" name="stream_id" value= "<?php echo $streamId ?>" ></td>
            <td><input type="submit" value="Get Record" name="getStream"></td>
        </tr>
        <tr>
            <td colspan="2">Stream</td>
            <td colspan="3"><input class="switch2" type="text" name="stream_name" value="<?php echo $streamName ?>"></td>
        </tr>
        <tr>
            <td ><input type="submit" value="Insert" name="insertStream"></td>
            <td><input type="submit" value="Update" name="updateStream"></td>
            <td><input type="submit" value="Delete" name="deleteStream"></td>
            <td><input type="submit" value="Get All Record" name="getAllStream"></td>
            </form>
            <form action="stream.php">
                <td><input type="submit" value="Refresh"></td>
            </form>    
        </tr>   
    </table>
</div>
<div id="footer">
		
</div>
</div>

</body>
</html>
<?php
}
?>

<?php
require 'connect_me.php';
if(isset($_POST['getStream']))
{
    $streamId = $_POST['stream_id'];
    if (isset($streamId) && is_numeric($streamId) && $streamId > 0)
    {
        $sql = "SELECT * FROM stream WHERE stream_id = $streamId";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_array($result);
        if($row)
        {
            $streamId = $row['stream_id'];
            $streamName = $row['stream_name'];
            renderForm($streamId, $streamName,'');
        }
        else
        {
            $error = "Record not found";
            renderForm('', '', $error);
        }
    }
    else
    {
        $error = "Please enter a valid stream id";
        renderForm('', '', $error);
    }
    
}
else if(isset($_POST['insertStream']))
{
    $streamId = $_POST['stream_id'];
    $streamName = ($_POST['stream_name']);
    if ((isset($streamId) && is_numeric($streamId) && $streamId > 0) && (isset($streamName) && $streamName <= 20))
    {
        $sql = "INSERT INTO stream values( $streamId ,'$streamName')";
        if(mysqli_query($con,$sql))
        {
            $error = "Record inserted successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to add record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter stream id and stream";
        renderForm('','',$error);
    }
}
else if(isset($_POST['updateStream']))
{
    $streamId = $_POST['stream_id'];
    $streamName = $_POST['stream_name'];
    if ((isset($streamName) && $streamName <= 50))
    {
        $sql = "UPDATE stream SET stream_name = '$streamName' WHERE stream_id = '$streamId'";
        if(mysqli_query($con,$sql))
        {
            $error = "Record updated successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to update record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter stream";
        renderForm('','',$error);
    }
}
else if(isset($_POST['deleteStream']))
{
    $streamId = $_POST['stream_id'];
    if (isset($streamId) && is_numeric($streamId) && $streamId > 0)
    {
        $sql = "DELETE FROM stream WHERE stream_id = $streamId";
        if(mysqli_query($con,$sql))
        {
            $error = "Record deleted successfully";
            renderForm('','',$error);
        }
        else
        {
            $error = "Unable to delete record";
            renderForm('','',$error);
        }
    }
    else
    {
        $error = "Please enter a valid stream id";
        renderForm('', '', $error);
    }
}
else if(isset($_POST['getAllStream']))
{
    header('Location: display-stream.php');
}
else
{
    $sql ="SELECT MAX(stream_id) AS max_stream_id FROM stream";
    $result = mysqli_query($con,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $streamId = $row['max_stream_id'] + 1;
    }
    renderForm($streamId,'','');
}

?>

