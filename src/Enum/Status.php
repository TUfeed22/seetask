<?php

namespace App\Enum;

enum Status: string
{
    case New = 'Новый';
    case Work = 'В работе';
    case Suspended = 'Приостановлен';
    case Done = 'Выполнен';
    case Cancelled = 'Отменен';
}
