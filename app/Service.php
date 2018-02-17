<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';//не обязательно если имя модели в ед числе совпад с имен табл в множ числе
    public $timestamps = TRUE;// автоматическое заполнение полей create и update
    protected $fillable = ['name','text','icon'];//список полей для которых разрешенно массовое заполнение
}
