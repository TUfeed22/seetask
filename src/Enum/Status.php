<?php

namespace App\Enum;

use PhpParser\Node\Expr\Array_;

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
            $options['options'][$status->value] = $status->value;
        }
        return $options;
    }
}
