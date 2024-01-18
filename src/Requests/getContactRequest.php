<?php

namespace Combindma\Mautic\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class getContactRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(protected int $contactId)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/contacts/'.$this->contactId;
    }


}
