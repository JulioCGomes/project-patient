<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Patient extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'name_mother',
        'date_both',
        'cpf',
        'cns',
        'image'
    ];

    /**
     * Relacionando marca ao veículos.
     *
     * @return Mixed
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
