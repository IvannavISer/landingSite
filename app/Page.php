<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $table = 'pages';//не обязательно если имя модели в ед числе совпад с имен табл в множ числе
    public $timestamps = TRUE;// автоматическое заполнение полей create и update
    protected $fillable = ['name','alias','text','images'];//список полей для которых разрешенно массовое заполнение
}
