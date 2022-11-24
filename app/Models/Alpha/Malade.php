<?php

namespace App\Models\Alpha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Traits\ModelTree;

class Malade extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;

    //table name
    protected $table = 'malades';
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'sexe',
        'category',
        'date_nais',
        'adresse',
        'image',
        'tutaire',
        'teletutaire',
        'adresse2',

    ];

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }

    public function localisation()
    {
        return $this->hasOne(Localisation::class);
    }
}
