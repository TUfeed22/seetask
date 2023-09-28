<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use App\Enum\Status;

#[AsTwigComponent]
class StatusComponent
{
    public string $status;

    public function mount($status): void
    {
        $this->status = Status::render($status);
    }
}
