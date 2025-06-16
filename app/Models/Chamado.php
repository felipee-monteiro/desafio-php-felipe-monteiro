<?php

declare(strict_types=1);

namespace App\Models;

use App\Composables\ParseTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Chamado extends Model
{
    use ParseTimestamps;
    protected $fillable = [
        'user_id',
        'tecnico_id',
        'titulo',
        'descricao',
        'status_chamados_id',
        'categoria_chamado_id',
        'prioridade_chamado_id',
        'anexo',
    ];
    protected $hidden = ['categoria_chamado_id'];
    protected $with   = ['categoria', 'responsavel', 'status', 'prioridade'];

    /**
     * Get the respostas for the chamado.
     *
     * @return HasMany<Resposta, $this>
     */
    public function respostas(): HasMany
    {
        return $this->hasMany(Resposta::class);
    }

    /**
     * Respons vel pelo chamado.
     *
     * @return BelongsTo<User, $this>
     */
    public function responsavel(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Categoria do chamado.
     *
     * @return BelongsTo<CategoriaChamado, $this>
     */
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaChamado::class, 'categoria_chamado_id');
    }

    /**
     * Status do chamado.
     *
     * @return HasOne<StatusChamado, $this>
     */
    public function status(): HasOne
    {
        return $this->hasOne(StatusChamado::class, 'id', 'status_chamados_id');
    }

    /**
     * Prioridade do chamado.
     *
     * @return HasOne<PrioridadeChamado, $this>
     */
    public function prioridade(): HasOne
    {
        return $this->hasOne(PrioridadeChamado::class, 'id', 'prioridade_chamado_id');
    }
}
