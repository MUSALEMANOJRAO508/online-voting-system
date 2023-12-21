<?php
session_start();
include("connect.php");

$votes = $_POST['gvotes'];
$total_votes = $votes + 1;
$gid = $_POST['gid'];
$uid = $_SESSION['userdata']['id'];

// Update votes for the specified group ID
$update_votes = mysqli_query($connect, "UPDATE user SET votes='$total_votes' WHERE id='$gid'");

// Update user status for the current user ID
$update_user_status = mysqli_query($connect, "UPDATE user SET status=1 WHERE id='$uid'");

if ($update_votes && $update_user_status) {
    // Fetch groups with role 2 and update session data
    $groups = mysqli_query($connect, "SELECT * FROM user WHERE role=2");
    $groupsdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);
    
    // Update session data
    $_SESSION['userdata']['status'] = 1;
    $_SESSION['groupsdata'] = $groupsdata;
    
    // Redirect or perform further actions
    // For example, redirect to Dashboard.php
    header('Location: ../');
    exit();
} else {
    echo "
        <script>
        alert('Something went wrong');
        window.location='../OLVS/Dashboard.php';
        </script>";
}
?>