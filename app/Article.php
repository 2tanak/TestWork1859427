<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
class Article extends Model
{
    //
    protected $table = 'articles';
    protected $fillable = ['title','text','img'];
	protected $defaultDir = '/public/files';
    
    
    public function user() {
		//return $this->belongsTo('Corp\User');
	}
	
	public function getDefaultDir()
    {
        if (is_null($this->defaultDir)) {
            throw new \Exception('Default directory not found in '.__CLASS__);
        }
        return $this->defaultDir;
    }
	
	
      public function upload(UploadedFile $file){
	
	  $dir = sprintf('/%s/%s', ltrim($this->getDefaultDir(), '/'), Carbon::now()->format('Y/m/d'));
		
        $disk = 'local';

        $path = $file->store($dir, $disk);
		
		$name = ltrim($path, $dir);
        
		
		return $dir.'/'.$name;
	
      }
 
 
	public function category() {
		//return $this->belongsTo('Corp\Category');
	}
	
	public function comments()
    {
        //return $this->hasMany('Corp\Comment');
    }	
	
}
