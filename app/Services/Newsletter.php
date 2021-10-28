<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

         return $this->client()->lists->addListMember($list, [ //.env
                "email_address" => $email,
                "status" => "subscribed", // enum (collection de valeurs possibles)
            ]);
    }

    protected function client()
    {
        $mailchimp = new ApiClient();

        return $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => config('services.mailchimp.server-prefix'),
        ]);
    }

}
