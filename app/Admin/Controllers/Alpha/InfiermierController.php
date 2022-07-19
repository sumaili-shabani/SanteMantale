<?php

namespace App\Admin\Controllers\Alpha;

use App\Models\Alpha\Infirmier;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InfiermierController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Infirmier';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Infirmier());
        $grid->column('nom', __('Nom'))->display(function($val){
           return substr($val, 0, 40).'...'; 
        });
        $grid->email()->display(function ($email) {
            return "<a href='mailto:$email'>$email</a>";
        });
        
        $grid->column('telephone', __('Téléphone'))->display(function($val){
          return "<a href='tel:$val'>$val</a>";
        });
        // $grid->column('ArticleType.title', __('Category'));
        $grid->column('sexe', __('Author'));
       
        // $grid->column('category', __('Catégorie'));

        $grid->column('category')->editable('select', [
            'Infirmier traitant' => 'Infirmier traitant',
            'Psychiatre' => 'Psychiatre',
            'Medecin ordinaire' => 'Medecin ordinaire' 
        ]);

        $grid->column('image', __('Image'))->image('','80', '80')->display(function($val){
            if(empty($val)){
                return "No Thumbnal";
            }
            return $val;
        });
        $grid->column('specialite', __('Specialité'))->style('max-width:200px;word-break:break-all;')->display(function ($val){
            return substr($val,0,30);
        });



        $grid->column('created_at', __('Created_at'));
        
        $grid->filter(function($filter){
           $filter->disableIdFilter();
           $filter->like('nom', __('Nom'));
           $filter->like('prenom', __('Prenom'));
           $filter->like('specialite', __('Specialité'));

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
        $show = new Show(Infirmier::findOrFail($id));



        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Infirmier());

        $form->text('nom', __('Nom du malade'))->required();
        $form->text('prenom', __('Prenom du malade'))->required();
        $form->email('email', __('Adresse email'))->required();

        $form->text('telephone', __('Téléphone'));
        $form->select('sexe',  __('Sexe'))->options(['M' => 'Masculin', 'F' => 'Feminin']);
        $form->select('category',  __('Catégorie'))->options([
            'Infirmier traitant' => 'Infirmier traitant',
            'Psychiatre' => 'Psychiatre',
            'Medecin ordinaire' => 'Medecin ordinaire' 
        ]);
        $form->date('date_nais', __('Date de naissance'));
        $form->text('adresse', __('Adresse domicile'));
        $form->file('cv', __('Atacher le cv'))->move('/infirmier/cv/')->uniqueName();
        $form->image('image', __('Photo'))->move('/infirmier/')->uniqueName();
        $form->textarea('specialite',"Spécialité de l'infirmier")->rows(2);

        return $form;
    }
}
