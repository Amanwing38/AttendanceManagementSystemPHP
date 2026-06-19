<?php

declare(strict_types=1);

function redirect(string $path): never
{
    header("Location: {$path}");
    exit;
}

function flash(?string $message = null, string $type = 'success'): ?array
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if ($message !== null) {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type,
        ];
        return null;
    }

    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function activePage(string $page): string
{
    return basename($_SERVER['PHP_SELF']) === $page ? 'active' : '';
}

