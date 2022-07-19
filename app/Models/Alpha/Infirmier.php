<?php

namespace App\Models\Alpha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Traits\ModelTree;

class Infirmier extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use ModelTree;
    //table name
    protected $table = 'infirmiers';
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'sexe',
        'category',
        'date_nais',
        'adresse',
        'cv',
        'image',
        'specialite',

    ];

    public function traitement()
    {
        return $this->hasOne(traitement::class);
    }
}
