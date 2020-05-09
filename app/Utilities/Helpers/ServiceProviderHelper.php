<?php

namespace App\Utilities\Helpers;

use App\Services\IEmailProvider;
use App\Services\Implementation\EmailSenderProvider;
use App\Services\Implementation\SendGridProvider;
use App\Utilities\Enums\EmailProviderEnum;

class ServiceProviderHelper
{
    public static function GetEmailProvider(int $emailProviderEnum): IEmailProvider
    {
        switch ($emailProviderEnum) {
            case EmailProviderEnum::SENDGRID_PROVIDER:
                return new SendGridProvider;
            default:
                return new EmailSenderProvider;
        }
    }
}
