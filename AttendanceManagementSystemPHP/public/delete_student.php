<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    flash('Invalid student ID.', 'error');
    redirect('students.php');
}

$statement = $pdo->prepare('DELETE FROM students WHERE id = ?');
$statement->execute([$id]);

flash($statement->rowCount() > 0 ? 'Student deleted successfully.' : 'Student not found.');
redirect('students.php');

