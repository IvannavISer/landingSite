<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'peoples';//не обязательно если имя модели в ед числе совпад с имен табл в множ числе
    public $timestamps = TRUE;// автоматическое заполнение полей create и update
    protected $fillable = ['name','position','images','text'];//список полей для которых разрешенно массовое заполнение
}
