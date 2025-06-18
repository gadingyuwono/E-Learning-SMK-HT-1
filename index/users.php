<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users</title>
  <link rel="stylesheet" href="css/users_style.css">
</head>

<body>

  <nav>
    <div class="nav-left">
      <img src="../asset/img/logo_hang_tuah.png" alt="" width="50" height="auto">
      <div class="school-name">
        <p>SMK Hang Tuah 1 Jakarta</p>
        <p class="smk-pk">SMK Pusat Keunggulan</p>
      </div>
    </div>
    <div class="nav-right">
      <ul>
        <li><a href="admin_dashboard.html">Dashboard</a></li>
        <li><a href="class.html">Teaching Class</a></li>
        <li><a href="data.html">Class Data</a></li>
        <li><a href="subject.html">Subject</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="grading.html">Grading</a></li>
        <li><a href="admin_result.html">Results</a></li>
        <li><a href="admin_schedule.html">Schedules</a></li>
        <li><a href="admin_announcement.html">Announcement</a></li>
        <li><a href="admin_profile.html">Profile</a></li>
        <li class="logout-btn"><a class="logout" href="../index.html">Logout</a></li>
      </ul>
    </div>
  </nav>

  <header>
    <h2>CRUD Users</h2>
  </header>

  <div class="container1">
    <div class="header">
      <div class="title-section">
        <h2>All Users</h2>
        <p class="from-admin">From <span>Admin</span></p>
      </div>
      <button onclick="window.print()">Download</button>
    </div>

    <div class="table-header">
      <h3>Users Data</h3>
      <div class="controls">
        <form method="GET" class="filter-form">
          <label for="role">Filter by role: </label>
          <select name="role" id="role" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="student" <?= isset($_GET['role']) && $_GET['role'] === 'student' ? 'selected' : '' ?>>Student</option>
            <option value="teacher" <?= isset($_GET['role']) && $_GET['role'] === 'teacher' ? 'selected' : '' ?>>Teacher</option>
            <option value="admin" <?= isset($_GET['role']) && $_GET['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
          </select>
        </form>
        <a href="add_user.php" class="btn-add">Add</a>
      </div>
    </div>

    <table class="user-table">
      <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Role</th>
          <th>Username</th>
          <th>Password</th>
          <th>Time</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        include 'db.php';

        $no = 1;
        $roleFilter = $_GET['role'] ?? '';

        if ($roleFilter !== '') {
          $stmt = $conn->prepare("SELECT * FROM users WHERE role = ?");
          $stmt->bind_param("s", $roleFilter);
        } else {
          $stmt = $conn->prepare("SELECT * FROM users");
        }

        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
          $nameSafe = htmlspecialchars($row['name'], ENT_QUOTES);
          echo "<tr>
        <td>{$no}</td>
        <td onclick=\"showFullName('{$nameSafe}')\" style=\"cursor:pointer; color:blue;\">{$nameSafe}</td>
        <td>{$row['role']}</td>
        <td>{$row['username']}</td>
        <td>{$row['password']}</td>
        <td>{$row['created_at']}</td>
        <td>
            <a href='edit_user.php?id={$row['id']}' class='btn-edit'>Edit</a>
            <a href='delete_user.php?id={$row['id']}' class='btn-delete' onclick=\"return confirm('Yakin ingin hapus?')\">Delete</a>
        </td>
    </tr>";
          $no++;
        }

        $stmt->close();
        ?>
      </tbody>
    </table>
  </div>

  <div id="nameModal" class="modal" style="display:none;">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p id="fullName"></p>
    </div>
  </div>

  <script>
    // Ambil elemen modal
    const modal = document.getElementById("nameModal");
    const modalContent = document.getElementById("fullName");
    const spanClose = document.getElementsByClassName("close")[0];

    // Event saat klik nama
    function showFullName(name) {
      modal.style.display = "block";
      modalContent.textContent = name;
    }

    // Tutup modal saat klik tombol close
    spanClose.onclick = function() {
      modal.style.display = "none";
    }

    // Tutup modal saat klik di luar modal
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>

</html>