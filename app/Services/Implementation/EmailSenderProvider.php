<?php

namespace App\Services\Implementation;

use App\Services\IEmailProvider;

class EmailSenderProvider implements IEmailProvider
{
    public function SendEmail()
    {
        return "Send email from EmailSenderProvider";
    }
}
