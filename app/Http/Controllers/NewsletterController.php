<?php

namespace App\Http\Controllers;

use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;

class NewsletterController extends Controller
{
    public function __invoke(Newsletter $newsletter) // single action controller | Laravel va voir dans service container si Newsletter
    {
        request()->validate(['email' => 'required|email']);

        //$response = $mailchimp->lists->updateListMember("f94833cfd4", "caaded9227481bf7db3451add8d466e1", ['status' => 'subscribed']);
        try {
            $newsletter->subscribe(request('email'));
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
        }

        return redirect('/')->with('success', 'You are now signed up for our newsletter');
    }
}
