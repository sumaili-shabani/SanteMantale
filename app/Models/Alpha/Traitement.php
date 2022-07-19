<?php

namespace App\Models\Alpha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Traits\ModelTree;

class Traitement extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use ModelTree;

    //table name
    protected $table = 'traitements';
    protected $fillable = [
        'seance_id',
        'consultation_id',
        'evaluation',
        'resultat',

    ];

    public function seance()
    {
        return $this->belongsTo(Seance::class);
        
    }

    public function infirmier()
    {
        return $this->belongsTo(Infirmier::class);
        
    }
}
