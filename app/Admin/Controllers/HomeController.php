<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

use DB;
use PDF;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        

        $customer_data      = $this->get_customer_data();

        $mbrMalades         = $this->showCountTable("malades");
        $mbrConsultation    = $this->showCountTable("consultations");
        $mbrSeances         = $this->showCountTable("seances");

        $mbrInfirmiers      = $this->showCountTable("infirmiers");

        $dataPoints = array( 
            array("label"=>"Oxygen", "symbol" => "O","y"=>46.6),
            array("label"=>"Silicon", "symbol" => "Si","y"=>27.7),
            array("label"=>"Aluminium", "symbol" => "Al","y"=>13.9),
            array("label"=>"Iron", "symbol" => "Fe","y"=>5),
           
        );
        


        return $content
        ->title('Dashboard 2')
        ->description('Description du titre')
        ->view('dashboard2', [
            'data'              => 'postion',
            'customer_data'     =>  $customer_data,
            'mbrMalades'        =>  $mbrMalades,
            'mbrConsultation'   =>  $mbrConsultation,
            'mbrSeances'        =>  $mbrSeances,
            'mbrInfirmiers'     =>  $mbrInfirmiers,
            'name'              =>  'Patrona shabani sumaili',
            'dataPoints'        =>  $dataPoints,
        ]);
    }

    // voir les nombre sur les tables 
    function showCountTable($table)
    {
      $data = DB::table($table)->count();
      return $data;
    }


     public function getLocalisation(Content $content)
    {
        

       
        $initialMarkers2 = [
            [
                'position' => [
                    'lat' => 28.625485,
                    'lng' => 79.821091
                ],
                'draggable' => true
            ],
            [
                'position' => [
                    'lat' => 28.625293,
                    'lng' => 79.817926
                ],
                'draggable' => false
            ],
            [
                'position' => [
                    'lat' => 28.625182,
                    'lng' => 79.81464
                ],
                'draggable' => true
            ]
        ];

        $initialMarkers = $this->getPosition();


        return $content
        ->title('Localisation')
        ->description('Localisation actuelle')
        ->view('map', [
            
            'initialMarkers'        =>  $initialMarkers,
            
        ]);
    }

    function getPosition()
    {

        $data = [];
        $tab = DB::table('localisations')
        ->join('malades', 'malades.id', 'localisations.malade_id')
        ->select("localisations.id","localisations.lat","localisations.long","malades.nom","malades.prenom","malades.telephone","malades.image")
        ->get();

        foreach ($tab as $row) {
            // code...
            array_push($data, array(
                'position'  => [
                    'lat'   =>    $row->lat,
                    'lng'   =>    $row->long
                ],
                'infos'      =>  [
                    'nom'          =>  $row->nom,
                    'prenom'       =>  $row->prenom,
                    'telephone'    =>  $row->telephone,
                    'image'        =>  url('uploads/'.$row->image)
                ],
                'draggable' => false
            ));
        }

        return $data; 


    }


    //impressions des données
    function get_pdf_infirmier()
    {
        $customer_data = DB::table('infirmiers')
            ->limit(10)
            ->get();
        return $customer_data;
    }

    function pdfListe_infirmier()
    {
         set_time_limit(300);
         $pdf = \App::make('dompdf.wrapper');
         $html = $this->convert_customer_data_pdfInfirmier();
         $pdf->loadHTML($html);
         return $pdf->stream();
         // echo($html);
    }

    function convert_customer_data_pdfInfirmier()
    {
     $count = 0;
     $customer_data = $this->get_pdf_infirmier();
     $output = '
        <div style="border: 1px solid black; padding:0px;">
        <h3 align="center" style="color:blue;">
            REPUBLIQUE DEMOCRATIQUE DU CONGO<br>
            
            LISTE ENTIERE DES INFIRMIERS  ET LEURS SPECIALITE DANS LA GESTION DES TACHES DANS L\'HOPITAL 
             
        </h3>
        <h3 align="center">HOPITAL  <span>SANTE MANTALE KESHERO </span></h3><br>

         <table width="525" style="border-collapse: collapse; border: 0px;">
            <tr style="font-weight:bold; background:#ccc;">
                <th style="border: 1px solid; padding:5px;" width="20%">N°</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Catégorie</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Nom Complet</th>
                <th style="border: 1px solid; padding:5px;" width="15%">adresse</th>
                <th style="border: 1px solid; padding:5px;" width="15%">N° de téléphone</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Sexe</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Profil</th>
            </tr>
     ';  
     foreach($customer_data as $customer)
     {     
          $count++;
          $output .= '
          <tr>
               <td style="border: 1px solid; padding:1px;">
                <div align="center">'.$count.'</div>
               </td>
               <td style="border: 1px solid; padding:5px;"> 
                    <h4 style="color:blue;">'.$customer->category.'</h4>
                    
                     
               </td>
               <td style="border: 1px solid; padding:5px;"> 
                    <h4>'.$customer->nom.' '.$customer->prenom.'</h4>
                    <ul>
                        Coordonné principale
                        <li><b>Adresse mail: </b>'.$customer->email.'</li>
                        <li><b>Date de naissance: </b>

                         '.nl2br(substr(date(DATE_RFC822, strtotime($customer->date_nais)), 0, 23)).'

                        </li>
                       
                    </ul>
               </td>
               <td style="border: 1px solid; padding:5px;">'.$customer->adresse.'</td>
               <td style="border: 1px solid; padding:5px;">'.$customer->telephone.'</td>
               <td style="border: 1px solid; padding:5px;">'.$customer->sexe.'</td>
               <td style="border: 1px solid; padding:5px;"> 
                <ul>
                    <li><b>Spécialité</b>'.$customer->specialite.'</li>
                    <li>'.$customer_data->count().'</li>
                </ul>
                     
               </td>
          </tr>
          ';
     }
     $output .='
            <tr>
                <td colspan="5" style="border: 1px solid; padding:5px;" align="right">
                    <b>Nombre total actuel</b>
                </td>
                <td colspan="2" style="border: 1px solid; padding:5px;">
                 '.$customer_data->count().' Infirmier(s)
                </td>
            </tr>
     ';
     $output .= '</table>';
     $output .='
        <p>
        <br />
        </p>
            <p style="position:relative;left:500px;">

              Fait à Goma le '.date('Y-m-d').'
            </p>
        <br /><br /></div>
     ';
     return $output;
    }

    //impression leste des infirmier
    function get_customer_data()
    {
        $customer_data = DB::table('malades')
            ->limit(10)
            ->get();
        return $customer_data;
    }

    function pdfData()
    {
         set_time_limit(300);
         $pdf = \App::make('dompdf.wrapper');
         $html = $this->convert_customer_data_to_html();

            //############ Permitir ver imagenes si falla #####################
            $contxt = stream_context_create([
                'ssl' => [
                    'verify_peer' => FALSE,
                    'verify_peer_name' => FALSE,
                    'allow_self_signed' => TRUE,
                ]
            ]);

            $pdf = \PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
            $pdf->getDomPDF()->setHttpContext($contxt);
            //################################################################

         $pdf->loadHTML($html);
         return $pdf->stream();
         // echo($html);
    }

    function convert_customer_data_to_html()
    {
     $count = 0;
     $customer_data = $this->get_customer_data();
     $output = '
        <div style="border: 1px solid black; padding:0px;">
        <h3 align="center" style="color:blue;">
            REPUBLIQUE DEMOCRATIQUE DU CONGO<br>
            
            LISTE ENTIERE DES MALADES ET LEURS ETATS SANITAIRES 
             
        </h3>
        <h3 align="center">HOPITAL  <span>SANTE MANTALE KESHERO </span></h3><br>

         <table width="525" style="border-collapse: collapse; border: 0px;">
            <tr style="font-weight:bold; background:#ccc;">
                <th style="border: 1px solid; padding:5px;" width="20%">N°</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Catégorie</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Nom Complet</th>
                <th style="border: 1px solid; padding:5px;" width="15%">adresse</th>
                <th style="border: 1px solid; padding:5px;" width="15%">N° de téléphone</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Sexe</th>
                <th style="border: 1px solid; padding:5px;" width="20%">Tuteur</th>
            </tr>
     ';  
     foreach($customer_data as $customer)
     {     
          $count++;
          $output .= '
          <tr>
               <td style="border: 1px solid; padding:1px;">
                <div align="center">'.$count.'</div>
               </td>
               <td style="border: 1px solid; padding:5px;"> 
                    <h4 style="color:blue;">'.$customer->category.'</h4>
                    
                     
               </td>
               <td style="border: 1px solid; padding:5px;"> 
                    <h4>'.$customer->nom.' '.$customer->prenom.'</h4>
                    <ul>
                        Coordonné principale
                        <li><b>N° de téléphone: </b>'.$customer->teletutaire.'</li>
                        <li><b>Adresse domicile:</b>'.$customer->tutaire.'</li>
                    </ul>
               </td>
               <td style="border: 1px solid; padding:5px;">'.$customer->adresse.'</td>
               <td style="border: 1px solid; padding:5px;">'.$customer->telephone.'</td>
               <td style="border: 1px solid; padding:5px;">'.$customer->sexe.'</td>
               <td style="border: 1px solid; padding:5px;"> 
                <ul>
                    <li><b>Nom du tutaire</b>'.$customer->tutaire.'</li>
                    <li><b>N° de téléphone du tutaire</b>'.$customer->teletutaire.'</li>
                </ul>
                     
               </td>
          </tr>
          ';
     }
     $output .='
            <tr>
                <td colspan="5" style="border: 1px solid; padding:5px;" align="right">
                    <b>Nombre total actuel</b>
                </td>
                <td colspan="2" style="border: 1px solid; padding:5px;">
                 '.$customer_data->count().' Malade(s)
                </td>
            </tr>
     ';
     $output .= '</table>';
     $output .='
        <p>
        <br />
        </p>
            <p style="position:relative;left:500px;">

              Fait à Goma le '.date('Y-m-d').'
            </p>
        <br /><br /></div>
     ';
     return $output;
    }
    //fin

    public function position(Content $content)
    {
        $customer_data = $this->get_customer_data();


        return $content
        ->title('Dashboard 2')
        ->description('Description du titre')
        ->view('dashboard2', [
            'data' => 'postion',
            'customer_data' =>  $customer_data,
            'name' => 'Patrona shabani sumaili',
        ]);

    }
}
