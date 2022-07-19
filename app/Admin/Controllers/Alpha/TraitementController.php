<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Traitement;
use App\Models\Alpha\Seance;
use App\Models\Alpha\Infirmier;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

use DB;

class TraitementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Traitement';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Traitement());
        $grid->column('seance.nomSeance');
        $grid->column('seance.date_debit');
        $grid->column('seance.date_fin');
        $grid->column('infirmier.nom', __('Nombre Infirmier'))->display(function($val){
            return "<a href='#'>$val </a>";
        });
       

        $grid->column('evaluation', __('Evaluation trouvée'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });

        $grid->column('resultat', __('Résultat trouvé'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });

        $grid->filter(function($filter){
           $filter->disableIdFilter();
           $filter->like('evaluation', __('Evaluation trouvée'));

        }); 


        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Traitement::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Traitement());
        $form->select('seance_id', __('Code séance'))->options(
            DB::table('seances')
            ->get()
            ->pluck('nomSeance', 'id')
        );

        $form->select('infirmier_id', __("Nom de l'infirmier évaluation la séance"))->options(
            DB::table('infirmiers')
            ->get()
            ->pluck('nom', 'id')
        );
        $form->text('evaluation', __('Evaluation de la Séance'))->icon('fa-pencil')->required();
        $form->textarea('resultat', __('Résultat après évaluation de la Séance'))->required();


        return $form;
    }
}
