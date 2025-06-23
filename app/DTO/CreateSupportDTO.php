<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupport;

class CreateSupportDTO
{
    public function __construct(
        public string $subject,
        public string $status,
        public string $body,
    ) {}

    public static function makefromRequest(StoreUpdateSupport $request): self
    {
        return new self(
            $request->subject,
            'open',
            $request->body
        );
    }
}
