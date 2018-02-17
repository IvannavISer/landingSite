<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';//не обязательно если имя модели в ед числе совпад с имен табл в множ числе
    public $timestamps = TRUE;// автоматическое заполнение полей create и update
    protected $fillable = ['name','images'];//список полей для которых разрешенно массовое заполнение
}
