<?php

namespace Combindma\Mautic\Requests;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Traits\Body\HasJsonBody;

class searchContactRequest extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::GET;

    public function __construct(protected int $email)
    {
        //
    }

    public function resolveEndpoint(): string
    {
        return '/contacts/';
    }

    protected function defaultBody(): array
    {
        return [
            'where' => [
                [
                    'col' => 'email',
                    'expr' => '=',
                    'val' => $this->email
                ]
            ]
        ];
    }
}
