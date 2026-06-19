<?php
require_once __DIR__ . '/functions.php';
$flash = flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Management System</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <aside class="sidebar">
        <div class="brand">
            <span class="brand-mark">AMS</span>
            <span>Attendance</span>
        </div>
        <nav>
            <a class="<?= activePage('index.php') ?>" href="index.php">Dashboard</a>
            <a class="<?= activePage('students.php') ?>" href="students.php">Students</a>
            <a class="<?= activePage('attendance.php') ?>" href="attendance.php">Attendance</a>
            <a class="<?= activePage('records.php') ?>" href="records.php">Records</a>
            <a class="<?= activePage('reports.php') ?>" href="reports.php">Reports</a>
        </nav>
    </aside>

    <main class="main">
        <?php if ($flash): ?>
            <div class="alert <?= e($flash['type']) ?>"><?= e($flash['message']) ?></div>
        <?php endif; ?>

