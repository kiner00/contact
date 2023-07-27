<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactCollection;
use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use Contacts\Interface\CreateContactInterface;

class ContactsController extends Controller
{
    public function index(): ContactCollection
    {
        return new ContactCollection(Contact::get());
    }

    public function store(ContactRequest $request, CreateContactInterface $create): JsonResponse
    {
        // Contact::create([
        //     'name' => $request->name,
        //     'mobile_number' => $request->mobile_number,
        //     'address' => $request->address
        // ]);
        
        // if(env('FLAG') === '1.0'){
        //     #code for your v1
        //     Contact::create([
        //         'name' => $request->name,
        //         'mobile_number' => $request->mobile_number,
        //         'address' => $request->address
        //     ]);
        //     \Log::info('V1');
        // }else if(env('FLAG') === '2.0'){
        //     #code for your v2
        //     Contact::create([
        //         'name' => $request->name,
        //         'mobile_number' => $request->mobile_number,
        //         'address' => $request->address
        //     ]);
        //     \Log::info('V2');
        // }else{
        //     #code for your v2
        //     Contact::create([
        //         'name' => $request->name,
        //         'mobile_number' => $request->mobile_number,
        //         'address' => $request->address
        //     ]);
        //     \Log::info('PRODUCTION CODE');
        // }

        // $data = $create->createContact($request->validated());
        
        return response()->json([
            'created' => true,
            'message' => 'successfully created!'
        ], 201);
    }
}
