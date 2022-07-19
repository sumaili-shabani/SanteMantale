<?php

namespace App\Models\Alpha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Traits\ModelTree;

class Seance extends Model
{

    use HasFactory;
    use DefaultDatetimeFormat;
    use ModelTree;
    //table name
    protected $table = 'seances';
    protected $fillable = [
        'consultation_id',
        'nomSeance',
        'description',
        'date_debit',
        'date_fin',

    ];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
        
    }

    public function traitement()
    {
        return $this->hasOne(traitement::class);
    }
}
