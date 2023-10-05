<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class TableComponent
{

    public $entity;
    public string $type;
    public array $column;
    public function mount($entity, $type)
    {
        if ($type == 'project') {
            $this->column = [
                '#',
                'Наименование',
                'Кол-во задач',
                'Статус',
                'Создатель',
            ];
        }

        $this->entity = $entity;
    }
}
