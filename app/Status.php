<?php

declare(strict_types=1);

namespace App;

enum Status: string
{
    case ABERTO         = 'Aberto';
    case EM_ATENDIMENTO = 'Em Atendimento';
    case RESOLVIDO      = 'Resolvido';
    case FECHADO        = 'Fechado';
}
