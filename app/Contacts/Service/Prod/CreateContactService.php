<?php

namespace Contacts\Service\Prod;

use App\Http\Service\ContactService as Service;
use Contacts\Repository\ContactRepository;
use Contacts\Interface\CreateContactInterface;

class CreateContactService extends Service implements CreateContactInterface
{
    public $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function createContact($request)
    {
        \Log::info('PRODUCTION CODE');
        return $this->contactRepository->createContact($request);
    }
}