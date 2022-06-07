<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $appends = ['photo_path_full','pdf_path_full','author_name','author_desc'];

    function getPhotoPathFullAttribute(){
        return url('/'). $this->photo_path;
    }

    function getPdfPathFullAttribute(){
        return url('/'). $this->pdf_path;
    }

    function getAuthorNameAttribute(){
        $author = Author::find($this->id_author);
        if($author!=null){
            return $author->name;
        }else{
            return "-";
        }
    }

    function getAuthorDescAttribute(){
        $author = Author::find($this->id_author);
        if($author!=null){
            return $author->desc;
        }else{
            return "-";
        }
    }
}
