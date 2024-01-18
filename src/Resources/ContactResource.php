<?php

namespace Combindma\Mautic\Resources;

use Combindma\Mautic\Requests\CreateContactRequest;
use Combindma\Mautic\Requests\DeleteContactRequest;
use Combindma\Mautic\Requests\EditContactRequest;
use Combindma\Mautic\Requests\getContactsRequest;
use Combindma\Mautic\Requests\getContactRequest;
use Exception;
use Illuminate\Support\Facades\Log;
use Saloon\Http\Response;

class ContactResource extends Resource
{
    public function create(string $email, array $attributes = []): ?Response
    {
        if ($this->connector->isApiDisabled()) {
            return null;
        }

        try {
            return $this->connector->send(new CreateContactRequest($email, $attributes));
        } catch (Exception $e) {
            Log::error($e);
        }

        return null;
    }

    public function edit(int $contactId, array $attributes): ?Response
    {
        if ($this->connector->isApiDisabled()) {
            return null;
        }

        try {
            return $this->connector->send(new EditContactRequest($contactId, $attributes));
        } catch (Exception $e) {
            Log::error($e);
        }

        return null;
    }

    public function delete(int $id): ?Response
    {
        if ($this->connector->isApiDisabled()) {
            return null;
        }

        try {
            return $this->connector->send(new DeleteContactRequest($id));
        } catch (Exception $e) {
            Log::error($e);
        }

        return null;
    }

    public function getIdByEmail(string $email): ?Int
    {

        if ($this->connector->isApiDisabled()) {
            return null;
        }
        try {
            $query =  [
                'where' => [
                    [
                        'col' => 'email',
                        'expr' => 'eq',
                        'val' => $email
                    ]
                ],
                'limit' => 10
            ];


            $response = $this->connector->send(new getContactsRequest($email,$query));

            $json_response = $response->json();

            return array_keys($json_response['contacts'])[0];

        } catch (Exception $e) {
            Log::error($e);
        }
        return null;

    }

    public function get(int $id): ?String
    {
        if ($this->connector->isApiDisabled()) {
            return null;
        }
        try {

            $response = $this->connector->send(new getContactRequest($id));
            dd($response->json());
        } catch (Exception $e) {
            Log::error($e);
        }

        return null;
    }

    // public function search(string $email): ?Response
    // {

    //     if ($this->connector->isApiDisabled()) {
    //         return null;
    //     }

    //     try {
    //         return $this->connector->send(new SearchContactRequest($email));
    //     } catch (Exception $e) {
    //         Log::error($e);
    //     }

    //     return null;

    // }
}
