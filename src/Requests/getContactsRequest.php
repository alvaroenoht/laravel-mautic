<?php

namespace Combindma\Mautic\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

class getContactsRequest extends Request
{

    protected Method $method = Method::GET;

    public function __construct(protected string $email, protected ?array $filter = [])
    {
         
    }

    public function resolveEndpoint(): string
    {
        return '/contacts';
    }

    protected function defaultQuery(): array
    {
        return $this->filter;
    }

}
