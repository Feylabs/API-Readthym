<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteBook extends Model
{
    use HasFactory;

    protected $appends = ['book','user'];

    function getBookAttribute(){
        return Book::find($this->id_book);
    }

    function getUserAttribute(){
        return User::find($this->id_user);
    }

}
