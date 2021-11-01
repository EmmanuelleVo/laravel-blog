<?php

namespace App\Services;

use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    //protected $client; si pas php 8

    public function __construct(protected $client)
    {
        //$this->client = $client; si pas php 8
    }

    public function subscribe(string $email, string $list = null)
    {
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [ //.env
            "email_address" => $email,
            "status" => "subscribed", // enum (collection de valeurs possibles)
        ]);
    }

}
