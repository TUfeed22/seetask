<?php

namespace App\Service;

class ProjectService
{
    public function columnNames(): array
    {
        return [
            '#',
            'Наименование',
            'Кол-во задач',
            'Статус',
            'Создатель',
        ];
    }
}
