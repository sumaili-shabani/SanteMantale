<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Seance;
use App\Models\Alpha\Consultation;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
Use DB;

class SeanceController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Séance';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Seance());

        $grid->column('consultation.nomConsultation');
        $grid->column('consultation.dateCons');
        $grid->column('consultation.nbrSeance', __('Nombre de seance'))->display(function($val){
            return "<a href='#'>$val Seances</a>";
        });
       

        $grid->column('nomSeance', __('Nom de la seance'));
        $grid->column('description', __('Description  de la seance'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });
       
        $grid->column('date_debit', __('Date debit de la seance'));
        $grid->column('date_fin', __('Date fin de la seance'));

       


        $grid->filter(function($filter){
           $filter->disableIdFilter();
           $filter->like('nomSeance', __('Nom de la Séance'));

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
        $show = new Show(Seance::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Seance());
        // $form->select('malade_id', __('Malade'))->options((new Malade()));

        $form->select('consultation_id', __('Consultation'))->options(
            DB::table('consultations')
            ->get()

            ->pluck('nomConsultation', 'id')
        );
        $form->text('nomSeance', __('Nom de la Séance'))->icon('fa-pencil')->required();
        $form->textarea('description', __('Description de la Séance'));

        $form->datetime('date_debit', __('Date debit de la Séance'))->format('YYYY-MM-DD HH:mm:ss');
        $form->datetime('date_fin', __('Date fin de la Séance'))->format('YYYY-MM-DD HH:mm:ss');
        
        return $form;
    }
}
