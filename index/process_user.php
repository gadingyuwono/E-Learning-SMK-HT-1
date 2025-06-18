<?php
include 'db.php';

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';

if ($action === 'add') {
    // Simpan password langsung (plain text)
    $stmt = $conn->prepare("INSERT INTO users (name, username, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $username, $password, $role);
    $stmt->execute();
    $stmt->close();

    header("Location: users.php");
    exit;

} elseif ($action === 'edit' && $id) {
    if (!empty($password)) {
        // Update password jika diisi
        $stmt = $conn->prepare("UPDATE users SET name=?, username=?, password=?, role=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $username, $password, $role, $id);
    } else {
        // Tidak update password
        $stmt = $conn->prepare("UPDATE users SET name=?, username=?, role=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $username, $role, $id);
    }
    $stmt->execute();
    $stmt->close();

    header("Location: users.php");
    exit;

} else {
    echo "Invalid action!";
}
