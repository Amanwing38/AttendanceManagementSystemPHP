<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/header.php';

$studentCount = (int) $pdo->query('SELECT COUNT(*) FROM students')->fetchColumn();
$attendanceCount = (int) $pdo->query('SELECT COUNT(*) FROM attendance')->fetchColumn();
$presentToday = (int) $pdo
    ->query("SELECT COUNT(*) FROM attendance WHERE attendance_date = CURDATE() AND status = 'Present'")
    ->fetchColumn();
$absentToday = (int) $pdo
    ->query("SELECT COUNT(*) FROM attendance WHERE attendance_date = CURDATE() AND status = 'Absent'")
    ->fetchColumn();

$recentRecords = $pdo->query("
    SELECT s.name, s.department, a.attendance_date, a.status
    FROM attendance a
    INNER JOIN students s ON s.id = a.student_id
    ORDER BY a.attendance_date DESC, a.id DESC
    LIMIT 6
")->fetchAll();
?>

<section class="page-title">
    <div>
        <h1>Dashboard</h1>
        <p>Quick view of students and attendance activity.</p>
    </div>
    <a class="button primary" href="attendance.php">Mark Attendance</a>
</section>

<section class="stats-grid">
    <div class="stat">
        <span>Total Students</span>
        <strong><?= e($studentCount) ?></strong>
    </div>
    <div class="stat">
        <span>Attendance Records</span>
        <strong><?= e($attendanceCount) ?></strong>
    </div>
    <div class="stat">
        <span>Present Today</span>
        <strong><?= e($presentToday) ?></strong>
    </div>
    <div class="stat">
        <span>Absent Today</span>
        <strong><?= e($absentToday) ?></strong>
    </div>
</section>

<section class="panel">
    <div class="panel-header">
        <h2>Recent Attendance</h2>
        <a href="records.php">View all</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Department</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$recentRecords): ?>
                <tr><td colspan="4" class="empty">No attendance records yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($recentRecords as $record): ?>
                <tr>
                    <td><?= e($record['name']) ?></td>
                    <td><?= e($record['department']) ?></td>
                    <td><?= e($record['attendance_date']) ?></td>
                    <td><span class="badge <?= strtolower(e($record['status'])) ?>"><?= e($record['status']) ?></span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

