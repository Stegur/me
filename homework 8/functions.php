<?php

session_start();

function login(string $login, string $password): bool
{
    $user = getUser($login);
    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $user;
        return true;
    }
    return false;
}

function getUser($login)
{
    $fileData = file_get_contents(__DIR__ . "/users/{$login}.json");
    if ($fileData) {
        $userArray = json_decode($fileData, true);
        foreach ($userArray as $user) {
            return $user;
        }
    }
    return [];
}