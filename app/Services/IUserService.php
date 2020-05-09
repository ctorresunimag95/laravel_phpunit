<?php

namespace App\Services;

interface IUserService
{
    public function GetAllUsers();

    public function CreateUser(array $user);

    public function GetUsersWithBook();

    public function GetUserById(int $userId);

    public function UpdateUser(array $user);

    public function TestEmailServiceProvider(int $emailServiceProvider);
}
