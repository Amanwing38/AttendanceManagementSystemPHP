<?php
require_once __DIR__ . '/../config/database.php';

$reports = $pdo->query("
    SELECT s.id, s.name, s.department,
           COUNT(a.id) AS total_days,
           COALESCE(SUM(CASE WHEN a.status = 'Present' THEN 1 ELSE 0 END), 0) AS present_days,
           COALESCE(SUM(CASE WHEN a.status = 'Absent' THEN 1 ELSE 0 END), 0) AS absent_days
    FROM students s
    LEFT JOIN attendance a ON s.id = a.student_id
    GROUP BY s.id, s.name, s.department
    ORDER BY s.id
")->fetchAll();

require_once __DIR__ . '/header.php';
?>

<section class="page-title">
    <div>
        <h1>Reports</h1>
        <p>Attendance totals and percentages by student.</p>
    </div>
</section>

<section class="panel">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Total Days</th>
                <th>Present</th>
                <th>Absent</th>
                <th>Attendance %</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$reports): ?>
                <tr><td colspan="7" class="empty">No students found.</td></tr>
            <?php endif; ?>
            <?php foreach ($reports as $report): ?>
                <?php
                $totalDays = (int) $report['total_days'];
                $presentDays = (int) $report['present_days'];
                $percentage = $totalDays === 0 ? 0 : ($presentDays / $totalDays) * 100;
                ?>
                <tr>
                    <td><?= e($report['id']) ?></td>
                    <td><?= e($report['name']) ?></td>
                    <td><?= e($report['department']) ?></td>
                    <td><?= e($totalDays) ?></td>
                    <td><?= e($presentDays) ?></td>
                    <td><?= e($report['absent_days']) ?></td>
                    <td><?= e(number_format($percentage, 2)) ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

