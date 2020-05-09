<?php

namespace App\Models\Utilities;

use App\Models\Utilities\BaseResponseModel;

class ErrorResponseModel extends BaseResponseModel
{
    public $message = '';
    public $exceptionMessage = '';
    public $errors = [];
}
