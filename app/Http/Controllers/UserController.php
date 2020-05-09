<?php

namespace App\Http\Controllers;

use App\Services\IUserService;
use App\Http\Requests\FormRequests\CreateUserDto;
use App\Http\Requests\FormRequests\EditUserDto;
use App\Utilities\Constants\ResponseMessages;
use App\Utilities\Helpers\ResponseHelper;
use App\Utilities\Enums\HttpResponseEnum;
use Exception;
use OutOfBoundsException;

class UserController extends Controller
{
    private $userServiceRepository;

    public function __construct(IUserService $userServiceRepository)
    {
        $this->userServiceRepository = $userServiceRepository;
    }

    public function GetAllUsers()
    {
        try {
            $users = $this->userServiceRepository->GetAllUsers();
            return ResponseHelper::GetSuccesResponse(true, $users, HttpResponseEnum::HTTP_OK);
        } catch (Exception $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::GENERIC_ERROR_MESSAGE,
                $e,
                HttpResponseEnum::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function CreateUser(CreateUserDto $request)
    {
        try {
            $user = $this->userServiceRepository->CreateUser($request->toArray());
            return ResponseHelper::GetSuccesResponse(true, $user, HttpResponseEnum::HTTP_CREATED);
        } catch (Exception $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::GENERIC_ERROR_MESSAGE,
                $e,
                HttpResponseEnum::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function GetUsersWithBook()
    {
        try {
            $users = $this->userServiceRepository->GetUsersWithBook();
            return ResponseHelper::GetSuccesResponse(true, $users, HttpResponseEnum::HTTP_OK);
        } catch (Exception $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::GENERIC_ERROR_MESSAGE,
                $e,
                HttpResponseEnum::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function GetUserById(int $userId)
    {
        try {
            $userFound = $this->userServiceRepository->GetUserById($userId);
            return ResponseHelper::GetSuccesResponse(true, $userFound, HttpResponseEnum::HTTP_OK);
        } catch (OutOfBoundsException $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::NOT_FOUND_ERROR_RESPONSE,
                $e,
                HttpResponseEnum::HTTP_NOT_FOUND
            );
        } catch (Exception $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::GENERIC_ERROR_MESSAGE,
                $e,
                HttpResponseEnum::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function UpdateUser(EditUserDto $request)
    {
        try {
            $user = $this->userServiceRepository->UpdateUser($request->toArray());
            return ResponseHelper::GetSuccesResponse(true, $user, HttpResponseEnum::HTTP_OK);
        } catch (OutOfBoundsException $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::NOT_FOUND_ERROR_RESPONSE,
                $e,
                HttpResponseEnum::HTTP_NOT_FOUND
            );
        } catch (Exception $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::GENERIC_ERROR_MESSAGE,
                $e,
                HttpResponseEnum::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function TestServiceProvider(int $emailServiceProvider)
    {
        try {
            $response = $this->userServiceRepository->TestEmailServiceProvider($emailServiceProvider);
            return ResponseHelper::GetSuccesResponse(true, $response, HttpResponseEnum::HTTP_OK);
        } catch (Exception $e) {
            return ResponseHelper::GetErrorResponse(
                false,
                ResponseMessages::GENERIC_ERROR_MESSAGE,
                $e,
                HttpResponseEnum::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
