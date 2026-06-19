<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $department = trim($_POST['department'] ?? '');

    if ($name === '' || $department === '') {
        flash('Student name and department are required.', 'error');
        redirect('students.php');
    }

    $statement = $pdo->prepare('INSERT INTO students (name, department) VALUES (?, ?)');
    $statement->execute([$name, $department]);

    flash('Student added successfully.');
    redirect('students.php');
}

$students = $pdo->query('SELECT id, name, department FROM students ORDER BY id DESC')->fetchAll();
require_once __DIR__ . '/header.php';
?>

<section class="page-title">
    <div>
        <h1>Students</h1>
        <p>Add, view, and remove student records.</p>
    </div>
</section>

<section class="layout-two">
    <form class="panel form-panel" method="post">
        <h2>Add Student</h2>
        <label>
            Student Name
            <input type="text" name="name" maxlength="100" required>
        </label>
        <label>
            Department
            <input type="text" name="department" maxlength="50" required>
        </label>
        <button class="button primary" type="submit">Add Student</button>
    </form>

    <section class="panel">
        <div class="panel-header">
            <h2>Student List</h2>
            <span><?= count($students) ?> total</span>
        </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!$students): ?>
                    <tr><td colspan="4" class="empty">No students found.</td></tr>
                <?php endif; ?>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?= e($student['id']) ?></td>
                        <td><?= e($student['name']) ?></td>
                        <td><?= e($student['department']) ?></td>
                        <td>
                            <a class="button danger small" href="delete_student.php?id=<?= e($student['id']) ?>" onclick="return confirm('Delete this student?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</section>

<?php require_once __DIR__ . '/footer.php'; ?>

