<?php

namespace Tests\Feature;

use App\Models\Eloquent\User;
use App\Utilities\Constants\ResponseMessages;
use App\Utilities\Enums\HttpResponseEnum;
use App\Utilities\Helpers\ResponseHelper;
use Tests\Feature\ControllerTestBase;

class UserControllerTest extends ControllerTestBase
{
    private const USER_CONTROLLER_ENDPOINT = "/api/users";

    private const NUMBER_OF_USERS_TO_CREATE = 5;
    private const INVALID_ID = -1;
    private const CREATED_ID = 6;

    protected function Provission()
    {
        factory(User::class, self::NUMBER_OF_USERS_TO_CREATE)->create();
    }

    public function testGetAllUsersSuccess()
    {
        $response = $this->get(self::USER_CONTROLLER_ENDPOINT);

        $response->assertStatus(HttpResponseEnum::HTTP_OK);
        $responseData = ResponseHelper::ParseResponseToJson($response);
        $this->assertEquals(count($responseData->data), self::NUMBER_OF_USERS_TO_CREATE);
    }

    public function testCreateUserSuccess()
    {
        $response = $this->postJson(self::USER_CONTROLLER_ENDPOINT . '/create', ['Name' => $this->faker->name]);
        $response->assertStatus(HttpResponseEnum::HTTP_CREATED);
        $responseData = ResponseHelper::ParseResponseToJson($response);
        $this->assertEquals($responseData->data->Id, self::CREATED_ID);
    }

    public function testCreateExpectedException()
    {
        $response = $this->postJson(self::USER_CONTROLLER_ENDPOINT . '/create', ['Name' => '']);
        $response->assertStatus(HttpResponseEnum::HTTP_UNPROCESSABLE_ENTITY);
        $responseData = ResponseHelper::ParseResponseToJson($response);
        $this->assertEquals($responseData->message, ResponseMessages::REQUEST_MODEL_ERROR_RESPONSE);
    }
}
