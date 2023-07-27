<?php

namespace Contacts\Repository;

use App\Models\Contact;

class ContactRepository
{
    public function createContact($request)
    {
        return Contact::create([
            'name' => $request['name'],
            'mobile_number' => $request['mobile_number'],
            'address' => $request['address']
        ]);
    }
}