<?php
// add_user.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Add User</title>
  <link rel="stylesheet" href="css/users_style.css" />
</head>
<body>
  <h2>Add New User</h2>
  <form action="process_user.php" method="POST">
    <input type="hidden" name="action" value="add" />
    <label>Name:</label><br>
    <input type="text" name="name" required /><br>

    <label>Username:</label><br>
    <input type="text" name="username" required /><br>

    <label>Password:</label><br>
    <input type="password" name="password" required /><br>

    <label>Role:</label><br>
    <select name="role" required>
      <option value="admin">Admin</option>
      <option value="teacher">Teacher</option>
      <option value="student">Student</option>
    </select><br><br>

    <button type="submit">Save</button>
    <a href="users.php">Cancel</a>
  </form>
</body>
</html>
