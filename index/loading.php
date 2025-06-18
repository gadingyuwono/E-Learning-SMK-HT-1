<?php
session_start();
$role = $_SESSION['role'] ?? null;
$redirect_url = "index.html";

if ($role === "admin") {
    $redirect_url = "admin_dashboard.html";
} elseif ($role === "teacher") {
    $redirect_url = "teacher_dashboard.html";
} elseif ($role === "student") {
    $redirect_url = "student_dashboard.html";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Loading</title>
  <meta http-equiv="refresh" content="2;url=<?= $redirect_url ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      background: linear-gradient(135deg, #007BFF, #00C6FF);
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
      overflow: hidden;
    }

    .loader {
      width: 80px;
      height: 80px;
      border: 10px solid rgba(255, 255, 255, 0.2);
      border-top: 10px solid white;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    .loading-text {
      margin-top: 20px;
      color: white;
      font-size: 1.5em;
      font-weight: bold;
      text-shadow: 0 0 10px rgba(255,255,255,0.7);
    }

    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="loader"></div>
  </div>
</body>
</html>
