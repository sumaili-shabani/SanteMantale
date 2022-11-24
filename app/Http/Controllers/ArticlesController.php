<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\ArticleType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Traits\{GlobalMethod,Slug};

class ArticlesController extends Controller
{
    
    use GlobalMethod;
    
    public function welcomeInfo(){
        $data = DB::table("articles") 
        ->join('article_types','article_types.id', 'articles.type_id')
        ->select('articles.id',
            'article_types.id as article_type_id', 
            'article_types.title as title_article_type',
            'article_types.description as description_article_type',
            'article_types.order as order_article_type',
            'articles.type_id',
            'articles.title',
            'articles.description',
            'articles.article_content',
            'articles.author',
            'articles.is_recommend',
            'articles.slug',
            'articles.img',
            'articles.created_at',
        )
        ->orderBy("articles.id", "desc")
        ->get();
        $list = [];
        foreach ($data as $row) {
            $article_content=strip_tags($row->article_content);
            $article_content=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->article_content);

            $description_article_type=strip_tags($row->description_article_type);
            $description_article_type=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->description_article_type);  

            
            // code...
            array_push($list, array(
                'id'                        =>  $row->id,
                'title'                     =>  $row->title,
                'description'               =>  $row->description,
                'slug'                      =>  $row->slug,
                'article_content'           =>  $article_content,
                'is_recommend'              =>  $row->is_recommend,
                'author'                    =>  $row->author,
                'img'                       =>  $row->img,
                'type_id'                   =>  $row->type_id,
                'title_article_type'        =>  $row->title_article_type,
                'description_article_type'  =>  $description_article_type,
                'created_at'                =>  $row->created_at,

            ));
        }

        return $this->apiData($list);
        

    }

    public function fetch_sigle_article($id){
        $data = DB::table("articles") 
                ->join('article_types','article_types.id', 'articles.type_id')
                ->select('articles.id',
                    'article_types.id as article_type_id', 
                    'article_types.title as title_article_type',
                    'article_types.description as description_article_type',
                    'article_types.order as order_article_type',
                    'articles.type_id',
                    'articles.title',
                    'articles.description',
                    'articles.article_content',
                    'articles.author',
                    'articles.is_recommend',
                    'articles.slug',
                    'articles.img',
                    'articles.created_at',
                )
                ->where('articles.id', $id)
                ->get();
        $list = [];
        foreach ($data as $row) {
            $article_content=strip_tags($row->article_content);
            $article_content=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->article_content);

            $description_article_type=strip_tags($row->description_article_type);
            $description_article_type=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->description_article_type);  

            
            // code...
            array_push($list, array(
                'id'                        =>  $row->id,
                'title'                     =>  $row->title,
                'description'               =>  $row->description,
                'slug'                      =>  $row->slug,
                'article_content'           =>  $article_content,
                'is_recommend'              =>  $row->is_recommend,
                'author'                    =>  $row->author,
                'img'                       =>  $row->img,
                'type_id'                   =>  $row->type_id,
                'title_article_type'        =>  $row->title_article_type,
                'description_article_type'  =>  $description_article_type,
                'created_at'                =>  $row->created_at,

            ));
        }
        return response()->json([
            'data'  =>  $list
        ]);
        
    }

    public function fetch_getType_article($type_id){
        $data = DB::table("articles") 
                ->join('article_types','article_types.id', 'articles.type_id')
                ->select('articles.id',
                    'article_types.id as article_type_id', 
                    'article_types.title as title_article_type',
                    'article_types.description as description_article_type',
                    'article_types.order as order_article_type',
                    'articles.type_id',
                    'articles.title',
                    'articles.description',
                    'articles.article_content',
                    'articles.author',
                    'articles.is_recommend',
                    'articles.slug',
                    'articles.img',
                    'articles.created_at',
                )
                ->where('articles.type_id', $type_id)
                ->get();
        $list = [];
        foreach ($data as $row) {
            $article_content=strip_tags($row->article_content);
            $article_content=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->article_content);

            $description_article_type=strip_tags($row->description_article_type);
            $description_article_type=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->description_article_type);  

            
            // code...
            array_push($list, array(
                'id'                        =>  $row->id,
                'title'                     =>  $row->title,
                'description'               =>  $row->description,
                'slug'                      =>  $row->slug,
                'article_content'           =>  $article_content,
                'is_recommend'              =>  $row->is_recommend,
                'author'                    =>  $row->author,
                'img'                       =>  $row->img,
                'type_id'                   =>  $row->type_id,
                'title_article_type'        =>  $row->title_article_type,
                'description_article_type'  =>  $description_article_type,
                'created_at'                =>  $row->created_at,

            ));
        }
        return response()->json([
            'data'  =>  $list
        ]);
        
    }

    public function fetch_search_article(Request $request){

        if (!is_null($request->get('query'))) {
            # code...
            $query = $this->Gquery($request);
            
            $data = DB::table("articles") 
            ->join('article_types','article_types.id', 'articles.type_id')
            ->select('articles.id',
                'article_types.id as article_type_id', 
                'article_types.title as title_article_type',
                'article_types.description as description_article_type',
                'article_types.order as order_article_type',
                'articles.type_id',
                'articles.title',
                'articles.description',
                'articles.article_content',
                'articles.author',
                'articles.is_recommend',
                'articles.slug',
                'articles.img',
                'articles.created_at',
            )
            ->where('articles.title', 'like', '%'.$query.'%')
            ->orWhere('articles.article_content', 'like', '%'.$query.'%')
            ->orderBy("articles.id", "desc")
            ->get();
            $list = [];
            foreach ($data as $row) {
                $article_content=strip_tags($row->article_content);
                $article_content=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->article_content);

                $description_article_type=strip_tags($row->description_article_type);
                $description_article_type=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->description_article_type);  

                
                // code...
                array_push($list, array(
                    'id'                        =>  $row->id,
                    'title'                     =>  $row->title,
                    'description'               =>  $row->description,
                    'slug'                      =>  $row->slug,
                    'article_content'           =>  $article_content,
                    'is_recommend'              =>  $row->is_recommend,
                    'author'                    =>  $row->author,
                    'img'                       =>  $row->img,
                    'type_id'                   =>  $row->type_id,
                    'title_article_type'        =>  $row->title_article_type,
                    'description_article_type'  =>  $description_article_type,
                    'created_at'                =>  $row->created_at,

                ));
            }
            return response()->json([
                'data'  =>  $list
            ]);
           

        }

        $data = DB::table("articles") 
            ->join('article_types','article_types.id', 'articles.type_id')
            ->select('articles.id',
                'article_types.id as article_type_id', 
                'article_types.title as title_article_type',
                'article_types.description as description_article_type',
                'article_types.order as order_article_type',
                'articles.type_id',
                'articles.title',
                'articles.description',
                'articles.article_content',
                'articles.author',
                'articles.is_recommend',
                'articles.slug',
                'articles.img',
                'articles.created_at',
            )
            ->orderBy("articles.id", "desc")
            ->get();
            $list = [];
            foreach ($data as $row) {
                $article_content=strip_tags($row->article_content);
                $article_content=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->article_content);

                $description_article_type=strip_tags($row->description_article_type);
                $description_article_type=$Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$row->description_article_type);  

                
                // code...
                array_push($list, array(
                    'id'                        =>  $row->id,
                    'title'                     =>  $row->title,
                    'description'               =>  $row->description,
                    'slug'                      =>  $row->slug,
                    'article_content'           =>  $article_content,
                    'is_recommend'              =>  $row->is_recommend,
                    'author'                    =>  $row->author,
                    'img'                       =>  $row->img,
                    'type_id'                   =>  $row->type_id,
                    'title_article_type'        =>  $row->title_article_type,
                    'description_article_type'  =>  $description_article_type,
                    'created_at'                =>  $row->created_at,

                ));
            }
            return response()->json([
                'data'  =>  $list
            ]);

        
    }

    public function getTypeArticleType(){
        $data = DB::table("article_types") 
                ->join('articles','articles.type_id','article_types.id')
                ->select('article_types.id', 'article_types.title','article_types.description','article_types.order')
                ->get();
        return response()->json([
            'data'  =>  $data
        ]);
    }
    

}
