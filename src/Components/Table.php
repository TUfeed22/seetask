<?php

namespace App\Components;

use App\Service\ProjectService;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Table
{
    public array $columnNames;
    public string $title;
    public $entity;

    public function mount($columnNames)
    {
        $this->columnNames = explode(',', $columnNames);
    }
}
