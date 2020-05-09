<?php

namespace Tests\Unit;

use Tests\Unit\BaseTest;
use App\Services\Implementation\UserService;
use App\Models\Eloquent\User;
use OutOfBoundsException;

class UserServiceTest extends BaseTest
{
    private const NUMBER_OF_USERS_TO_CREATE = 4;
    private const INVALID_ID = -1;

    public function __construct()
    {
        parent::__construct();
        $this->manager = new UserService(new User);
    }

    protected function Provission()
    {
        factory(User::class, self::NUMBER_OF_USERS_TO_CREATE)->create();
    }

    public function testCreateUserSuccess()
    {
        $data = [
            'Name' => $this->faker->name
        ];

        $user = $this->manager->CreateUser($data);
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($data['Name'], $user->Name);
    }

    public function testGetAllUsersSuccess()
    {
        $users = $this->manager->GetAllUsers();
        $this->assertNotEmpty($users);
        $this->assertEquals($users->count(), self::NUMBER_OF_USERS_TO_CREATE);
    }

    public function testGetUserByIdExpectedException()
    {
        $this->expectException(OutOfBoundsException::class);
        $this->manager->GetUserById(self::INVALID_ID);
    }

    public function testGetUserByIdSuccess()
    {
        $users = $this->manager->GetAllUsers();
        $userToSearch = $users->first();
        $userFound = $this->manager->GetUserById($userToSearch['Id']);
        $this->assertEquals($userFound['Id'], $userToSearch['Id']);
    }
}
