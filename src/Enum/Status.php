<?php

namespace App\Enum;

enum Status: string
{
    case new = 'Новый';
    case work = 'В работе';
    case suspended = 'Приостановлено';
    case done = 'Выполнено';
    case cancelled = 'Отменено';

    /**
     * Возвращает массив пригодный для формирования select для формы
     *
     * @return array
     */
    public static function getOptionsToSelect(): array
    {
        $options = [];
        foreach (Status::cases() as $status) {
            $options['options'][$status->value] = $status->name;
        }
        return $options;
    }

    /**
     * Рендеринг статуса
     *
     * @param $status
     * @return string
     */
    public static function render($status): string
    {
        return match ($status) {
            Status::new->name => '<span class="badge bg-info" style="color: #000000">' . Status::new->value . '</span>',
            Status::work->name => '<span class="badge bg-primary" style="color: #000000">' . Status::work->value . '</span>',
            Status::suspended->name => '<span class="badge bg-warning" style="color: #000000">' . Status::suspended->value . '</span>',
            Status::done->name => '<span class="badge bg-success" style="color: #000000">' . Status::done->value . '</span>',
            Status::cancelled->name => '<span class="badge bg-danger" style="color: #000000">' . Status::cancelled->value . '</span>',
            default => '<span class="badge bg-secondary" style="color: #000000">' . $status . '</span>',
        };
    }
}
