<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentId = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
    $date = trim($_POST['attendance_date'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if (!$studentId || $date === '' || !in_array($status, ['Present', 'Absent'], true)) {
        flash('Please select a student, date, and valid status.', 'error');
        redirect('attendance.php');
    }

    $statement = $pdo->prepare('INSERT INTO attendance (student_id, attendance_date, status) VALUES (?, ?, ?)');
    $statement->execute([$studentId, $date, $status]);

    flash('Attendance marked successfully.');
    redirect('attendance.php');
}

$students = $pdo->query('SELECT id, name, department FROM students ORDER BY name')->fetchAll();
require_once __DIR__ . '/header.php';
?>

<section class="page-title">
    <div>
        <h1>Mark Attendance</h1>
        <p>Record whether a student is present or absent.</p>
    </div>
</section>

<form class="panel form-panel wide" method="post">
    <label>
        Student
        <select name="student_id" required>
            <option value="">Select student</option>
            <?php foreach ($students as $student): ?>
                <option value="<?= e($student['id']) ?>">
                    <?= e($student['name']) ?> - <?= e($student['department']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </label>

    <label>
        Date
        <input type="date" name="attendance_date" value="<?= e(date('Y-m-d')) ?>" required>
    </label>

    <label>
        Status
        <select name="status" required>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
        </select>
    </label>

    <button class="button primary" type="submit">Save Attendance</button>
</form>

<?php require_once __DIR__ . '/footer.php'; ?>

