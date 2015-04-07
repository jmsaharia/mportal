<?php
ob_start();
session_start();
//$current_file=$_SERVER['SCRIPT_NAME'];
$con=mysql_connect('localhost','root','g2mani');
mysql_select_db('mportal');
function loggedin()
{
    if(isset($_SESSION['roleid']) && !empty($_SESSION['roleid']))
    {
        return true;
    }
    else
    {
        return false;
    }
}

function getRole()
{
    $query="SELECT role_name FROM role WHERE role_id=".$_SESSION['roleid']."";
    if($query_run=mysql_query($query))
    {
        if($rolename=mysql_result($query_run,0,'role_name'))
        {
            return $rolename;
        }
    }
}
function getFacultyName()
{
    if(isset($_SESSION['faculty']))
    {
        return $_SESSION['faculty'];
    }
}

function getStudentName()
{
    if(isset($_SESSION['student']))
    {
        return $_SESSION['student'];
    }
}

function getRoleId()
{
    if(isset($_SESSION['roleid']) && !empty($_SESSION['roleid']))
    {
        return $_SESSION['roleid'];
    }
}
?>