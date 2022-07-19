<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Utilisateur;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UtilisateurController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Utilisateur';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Utilisateur());
        $grid->column('nom', __("Nom"))->setAttributes(['style' => 'color:blue;']);
        $grid->column('prenom', __("Prenom"));
        $grid->column('age', __("Age"));
        $grid->column('date_nais', __("Date de naissance"));
        $grid->column('sexe', __("Sexe"));


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
        $show = new Show(Utilisateur::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Utilisateur());

        $form->text('nom', __('Nom'))->icon('fa-user')->placeholder("Entrez le nom")->required();
        $form->text('prenom', __('Prenom'))->icon('fa-user')->placeholder("Entrez le prenom")->required();

        $form->select('sexe', __('Sexe'))->options([
            'M' => "Masculin", 
            'F' => "Feminin"
        ]);

        $form->number('age', __("Age de l'utilisateur"))->default(18)->required();

        $form->date('date_nais', __("Date de naissance"));



        return $form;
    }
}
