<?php
// edit_user.php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: users.php");
    exit;
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
if (mysqli_num_rows($query) == 0) {
    echo "User not found!";
    exit;
}

$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Edit User</title>
  <link rel="stylesheet" href="css/users_style.css" />
</head>
<body>
  <h2>Edit User</h2>
  <form action="process_user.php" method="POST">
    <input type="hidden" name="action" value="edit" />
    <input type="hidden" name="id" value="<?= $user['id'] ?>" />

    <label>Name:</label><br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required /><br>

    <label>Username:</label><br>
    <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required /><br>

    <label>Password: <small>(leave blank if not change)</small></label><br>
    <input type="password" name="password" /><br>

    <label>Role:</label><br>
    <select name="role" required>
      <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
      <option value="teacher" <?= $user['role'] === 'teacher' ? 'selected' : '' ?>>Teacher</option>
      <option value="student" <?= $user['role'] === 'student' ? 'selected' : '' ?>>Student</option>
    </select><br><br>

    <button type="submit">Update</button>
    <a href="users.php">Cancel</a>
  </form>
</body>
</html>
