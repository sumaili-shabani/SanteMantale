<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Malade;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class MaladeController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Malade';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Malade());

        $grid->column('id')->qrcode();
        
        $grid->column('nom', __('Nom'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });
        $grid->column('prenom', __('Prenom'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });

        $grid->column('telephone', __('Téléphone'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });

        $grid->column('sexe', __('Author'));
       

        $grid->column('category')->editable('select', [
            'Malade agressif' => 'Malade agressif',
            'Malade non agressif' => 'Malade non agressif'
        ]);

        $grid->column('image', __('Image'))->image('','80', '80')->display(function($val){
            if(empty($val)){
                return "No Thumbnal";
            }
            return $val;
        });

        $grid->column('tutaire', __('Tuteur'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });
        $grid->column('teletutaire', __('N° de téléphone du Tuteur'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });
        

        $grid->column('created_at', __('Created_at'));



       
        
        
        $grid->filter(function($filter){
           $filter->disableIdFilter();
           $filter->like('nom', __('Nom'));
           $filter->like('prenom', __('Prenom'));
           
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
        $show = new Show(Malade::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Malade());
        $form->text('nom', __('Nom du malade'))->required();
        $form->text('prenom', __('Prenom du malade'))->required();
        
        $form->text('telephone', __('Téléphone'));
        $form->select('sexe',  __('Sexe'))->options(['M' => 'Masculin', 'F' => 'Feminin']);
        $form->select('category',  __('Catégorie'))->options([
            'Malade agressif' => 'Malade agressif',
            'Malade non agressif' => 'Malade non agressif'
        ]);
        $form->date('date_nais', __('Date de naissance'));
        $form->text('adresse', __('Adresse domicile'));

        $form->image('image', __('Photo du malade'))->move('/malade/')->uniqueName();
        
        $form->text('tutaire', __('Nom du Tutaire'));
        $form->text('teletutaire', __('N° de téléphone du Tuteur'));
        $form->text('adresse2', __('Adresse domicile du tuteur'));


        return $form;
    }
}
