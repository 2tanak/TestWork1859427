<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\ArticlesRepository;

use App\Article;

use App\User;

use Auth;

use URL;

use Storage;

use Illuminate\Support\Facades\Validator;

class ArticlesController extends AdminController
{

    public function __construct(ArticlesRepository $a_rep)
    {
        $this->a_rep = $a_rep;
        $this->template = 'index';
    }

    public function index()
    {

        $this->title = 'Блог';
        $this->keywords = 'String';
        $this->meta_desc = 'String';

        $articles = $this
            ->a_rep
            ->get();
        return response()
            ->json($articles);
    }

    public function one(Article $article)
    {
        return response()->json($article);
    }

    public function store(Request $request)
    {
		
	   $validator = $this->validator($request->all());
			if($validator->fails()) { 
		     return 'error';
            };
			
        $name = null;
        $article = new Article;

        if ($request->hasFile('image'))
        {
            $name = $article->upload($request->file('image'));
            $name = str_replace('public', 'storage', $name);
        }

        $article->title = $request->title;
        $article->text = $request->description;
		if($name !=null){
        $article->img = $name;
		}
        $article->save();
        return 'ok';

    }

    public function update(Request $request, Article $article)
    {
		
        $validator = $this->validator($request->all());
			if($validator->fails()) { 
		     return 'error';
            };
			
        $name = null;
		
        if ($request->hasFile('image'))
        {
			
			if(is_file(public_path($article->img))){
	          Storage::delete($article->img);
            }
            $name = $article->upload($request->file('image'));
            $name = str_replace('public', 'storage', $name);
        }

        $article->title = $request->title;
        if($name !=null){
        $article->img = $name;
		}
		
        $article->text = $request->description;
        $res = $article->save();
        return 'ok';

    }

    public function destroy(Article $article)
    {
        //
        if ($article->delete())
        {
            return 'ok';

        }

    }
	
	 protected function validator(array $data)
    {
		
        return \Validator::make($data, [
		 'title' => 'required',
         'description' => 'required',
	     
        ]);
    }
}

