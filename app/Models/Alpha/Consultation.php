<?php

namespace App\Models\Alpha;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Encore\Admin\Traits\ModelTree;

class Consultation extends Model
{
    use HasFactory;
    use DefaultDatetimeFormat;
    use ModelTree;
    //table name
    protected $table = 'consultations';
    protected $fillable = [
        'malade_id',
        'dateCons',
        'resultat',
        'nbrSeance',
        'nomConsultation',
        
    ];

    public function malade()
    {
        return $this->belongsTo(Malade::class);
    }



    public function seance()
    {
        return $this->hasOne(Consultation::class);
    }

}
