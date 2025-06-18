<?php
// delete_user.php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = intval($_GET['id']);
mysqli_query($conn, "DELETE FROM users WHERE id = $id");
header("Location: users.php");
exit;
