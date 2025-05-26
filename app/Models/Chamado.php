<?php

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chamado extends Model
{
    use ParseTimestamps;

    protected $fillable = [
        'user_id',
        'tecnico_id',
        'titulo',
        'descricao',
        'categoria_chamado_id',
        'prioridade',
        'status',
        'anexo',
    ];

    protected $hidden = ['categoria_chamado_id'];
    protected $with = ['categoria', 'responsavel', 'status'];

    public function respostas(): HasMany {
        return $this->hasMany(Resposta::class);
    }

    public function responsavel(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function categoria(): BelongsTo {
        return $this->belongsTo(CategoriaChamado::class, "categoria_chamado_id");
    }

    public function status(): HasOne {
        return $this->hasOne(StatusChamado::class, 'id', 'status_chamados_id');
    }
}
