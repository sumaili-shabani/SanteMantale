<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Consultation;
use App\Models\Alpha\Malade;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ConsultationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Consultation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Consultation());

        
        // $grid->malade_id();

        // $grid->malade_id()->display(function($userId) {
        //     $nom = Malade::find($userId)->nom;
        //     $prenon = Malade::find($userId)->prenon;

        //     $teletutaire = Malade::find($userId)->teletutaire;
        //     return $nom.' '.$prenon.'| N° de téléphone du tutaire:'.$teletutaire;
        // });



        $grid->column('malade.nom');
        $grid->column('malade.prenom');


        $grid->column('malade.telephone', __('N° de Téléphone'))->display(function($val){
          return "<a href='tel:$val'>$val</a>";
        });

        $grid->column('dateCons', __('Date de Consultation'));
        $grid->column('nbrSeance', __('Nombre de seance'))->display(function($val){
            return "<a href='#'>$val Seances</a>";
        });
       

        $grid->column('malade.tutaire', __('N° de Téléphone'))->display(function($val){
            return "<a href='#'>$val</a>";
        });

        $grid->column('nomConsultation', __('Code-consultation Consultation'));

        $grid->column('created_at', __('Created_at'));
        $grid->column('updated_at', __('Updated_at'));

        $grid->filter(function($filter){
           $filter->disableIdFilter();
           $filter->like('dateCons', __('Date de Consultation'));
           // $filter->like('malades.nom', __('Nom malade'));
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
        $show = new Show(Consultation::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Consultation());
        
        $form->text('nomConsultation', __('Identifant de la consulation'))->icon('fa-pencil')->placeholder("Nom de la consulation")->required();

        $form->select('malade_id', __('Malade'))->options(Malade::all()->pluck('nom', 'id'));


        $form->date('dateCons', __('Date de Consultation'))->required();
        $form->UEditor('resultat', __('Résultat de Consultation'));
        $form->number('nbrSeance', __('Nombre de séance prélevé de Consultation'))
        ->default(1)->required();
        
        
        return $form;
    }
}
