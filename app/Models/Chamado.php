<?php

namespace App\Models;

use DateTimeZone;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chamado extends Model
{
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
    protected $with = ['categoria', 'responsavel'];

    protected function serializeDate(\DateTimeInterface $date)
    {
        $date->setTimezone(new DateTimeZone("America/Sao_Paulo"));
        return $date->format('c');
    }

    protected function formatDate(string $date): string {
        return \date_format(new \DateTime($date), "d/m/Y H:i:s");
    }

    protected function createdAt(): Attribute {
        return Attribute::make(
            get: fn(string $date) =>  $this->formatDate($date),
        );
    }

    protected function updatedAt(): Attribute {
        return Attribute::make(
            get: fn(string $date) => $this->formatDate($date),
        );
    }

    public function respostas(): HasMany {
        return $this->hasMany(Resposta::class);
    }

    public function responsavel(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function categoria(): BelongsTo {
        return $this->belongsTo(CategoriaChamado::class, "categoria_chamado_id");
    }
}
