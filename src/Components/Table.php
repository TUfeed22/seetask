<?php

namespace App\Components;

use App\Service\Service;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Table
{
    public array $columnNames;
    public $entity;

    /**
     * @var Service
     */
    private Service $service;
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function mount($columnNames, $entity)
    {
        if ($entity === 'project' ) {
            $this->entity = $this->service->getCurrentUser()->getProjects();
        }
        $this->columnNames = explode(',', $columnNames);
    }


}
