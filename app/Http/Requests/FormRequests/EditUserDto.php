<?php

namespace App\Http\Requests\FormRequests;

use App\Utilities\Constants\ResponseMessages;
use App\Utilities\Enums\HttpResponseEnum;
use App\Utilities\Helpers\ResponseHelper;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class EditUserDto extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'Id' => 'required|exists:users',
            'Name' => 'required|max:255'
        ];
    }

    public function messages()
    {
        return [
            'Id.required' => 'Please check the user information',
            'Id.exists' => 'Please check the user information',
            'Name.required' => 'Name field is required',
            'Name.max' => 'Name filed length must be max 255 characters',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(ResponseHelper::GetErrorFromRequest(
            false,
            ResponseMessages::REQUEST_MODEL_ERROR_RESPONSE,
            $validator->errors(),
            HttpResponseEnum::HTTP_UNPROCESSABLE_ENTITY
        ));
    }
}
