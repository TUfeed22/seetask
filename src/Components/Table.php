<?php

namespace App\Components;

use App\Service\Service;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Table
{
    public array $columnNames;
    public $entity;
    public $data;

    private Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function mount($columnNames, $entity)
    {
        if ($entity === 'project' ) {
            $this->data = $this->service->getCurrentUser()->getProjects();
        }
        $this->columnNames = explode(',', $columnNames);
    }


}
