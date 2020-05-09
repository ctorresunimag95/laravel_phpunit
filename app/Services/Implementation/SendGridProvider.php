<?php

namespace App\Services\Implementation;

use App\Services\IEmailProvider;

class SendGridProvider implements IEmailProvider
{
    public function SendEmail()
    {
        return "Send email from SendGridProvider";
    }
}
