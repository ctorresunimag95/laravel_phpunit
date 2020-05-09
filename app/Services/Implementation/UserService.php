<?php

namespace App\Services\Implementation;

use App\Models\Eloquent\User;
use App\Services\IUserService;
use App\Utilities\Helpers\ServiceProviderHelper;
use OutOfBoundsException;

//use App\Http\Requests\FormRequests\CreateUserDto;

class UserService implements IUserService
{
    private $usersRepository;

    public function __construct(User $user)
    {
        $this->usersRepository = $user;
    }

    public function GetAllUsers()
    {
        return $this->usersRepository->all();
    }

    public function CreateUser(array $user)
    {
        return $this->usersRepository->create($user);
    }

    public function GetUsersWithBook()
    {
        return $this->usersRepository->with(['Books'])->get();
    }

    public function GetUserById(int $userId)
    {
        $userFound = $this->usersRepository->find($userId);
        if (!$userFound) {
            throw new OutOfBoundsException("There is no user with id: $userId");
        }

        return $userFound;
    }

    public function UpdateUser(array $user)
    {
        $userToUpdate = $this->GetUserById($user['Id']);
        $userToUpdate->Name = $user['Name'];
        $userToUpdate->save();

        return $userToUpdate;
    }

    public function TestEmailServiceProvider(int $emailServiceProvider)
    {
        $emailProvider = ServiceProviderHelper::GetEmailProvider($emailServiceProvider);
        $response = $emailProvider->SendEmail();
        return $response;
    }
}
