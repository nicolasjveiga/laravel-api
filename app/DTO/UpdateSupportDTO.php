<?php

namespace App\DTO;

use App\Http\Requests\StoreUpdateSupport;

class UpdateSupportDTO
{
    public function __construct(
        public int $id,
        public string $subject,
        public string $status,
        public string $body,
    ) {}

    public static function makefromRequest(StoreUpdateSupport $request): self
    {
        return new self(
            $request->id,
            $request->subject,
            'open',
            $request->body
        );
    }
}
