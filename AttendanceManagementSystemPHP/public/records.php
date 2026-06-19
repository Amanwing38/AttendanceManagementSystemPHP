<?php
require_once __DIR__ . '/../config/database.php';

$records = $pdo->query("
    SELECT a.id, s.name, s.department, a.attendance_date, a.status
    FROM attendance a
    INNER JOIN students s ON s.id = a.student_id
    ORDER BY a.attendance_date DESC, a.id DESC
")->fetchAll();

require_once __DIR__ . '/header.php';
?>

<section class="page-title">
    <div>
        <h1>Attendance Records</h1>
        <p>All saved attendance entries.</p>
    </div>
</section>

<section class="panel">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$records): ?>
                <tr><td colspan="5" class="empty">No attendance records found.</td></tr>
            <?php endif; ?>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= e($record['id']) ?></td>
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

