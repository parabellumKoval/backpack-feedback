<?php

namespace Backpack\Feedback\app\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Feedback extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'ak_feedback';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];
    
    protected $casts = [
      'files' => 'array',
      'extras' => 'array'
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */
    
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
    public function setFilesAttribute($value) 
    {
      if(!$value || empty($value))
        return null;
        
      $files = [];
      
      foreach($value as $file){
        if(isset($file['name']))
        {
          
          $data = substr($file['data'], strpos($file['data'], ',') + 1);
          $data = base64_decode($data);
          
          $filename = Str::slug(time().'-'.$file['name']);
          Storage::disk('files')->put($filename, $data);
          $files[] = [ 'file' => 'uploads/files/'.$filename, 'name' => $file['name']];
        }else
        {
          $files[] = [
            'file' => $file,
          ];
        }
      }
      
      $this->attributes['files'] = json_encode($files);
    }
}

