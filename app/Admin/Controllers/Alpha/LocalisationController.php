<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Localisation;
use App\Models\Alpha\Malade;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LocalisationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Localisation';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Localisation());

        $grid->column('malade.nom', __('Nom du Malade'));
        $grid->column('malade.prenom', __('Prenom du Malade'));
        $grid->column('malade.telephone', __('N° de téléphone de son tuteur du Malade'));
        $grid->column('lat', __('Lat'));
        $grid->column('long', __('Long'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->disableExport();

        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();
        });

        $grid->filter(function($filter){
           $filter->disableIdFilter();
           $filter->like('malade.nom', __('Nom'));
           
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
        $show = new Show(Localisation::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('malade_id', __('Malade id'));
        $show->field('lat', __('Lat'));
        $show->field('long', __('Long'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Localisation());


        $form->select('malade_id', __('Malade'))->options(Malade::all()->pluck('nom', 'id'))
        ->required();

        $form->decimal('lat', __('Lat'))->required();
        $form->decimal('long', __('Long'))->required();

        return $form;
    }
}
