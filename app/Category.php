<?php

declare(strict_types=1);

namespace App;

enum Category: string
{
    case TI         = 'TI';
    case MANUTENCAO = 'Manutenção';
    case SUPORTE_RH = 'Suporte RH';
}
