# Attendance Management System - PHP Version

This is a complete PHP + MySQL attendance management system.

## Features

- Dashboard summary
- Add students
- View students
- Delete students
- Mark attendance
- View attendance records
- Generate attendance reports

## Requirements

- XAMPP
- PHP
- MySQL
- Browser

## Setup

1. Start Apache and MySQL in XAMPP.
2. Open phpMyAdmin.
3. Import `database/attendance.sql`.
4. Copy the `AttendanceManagementSystemPHP` folder into `xampp/htdocs`.
5. Visit:

```text
http://localhost/AttendanceManagementSystemPHP/public/
```

## Database Login

The default database login is in `config/database.php`:

```php
$username = 'root';
$password = '';
```

Change those values if your MySQL login is different.

