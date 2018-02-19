<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    //
    public function execute(){
        $pages = Page::all();
        $d = DB::table('pages')->distinct()->pluck('created_at')->all();
        $data = [
            'title' => 'Страницы',
            'pages' => $pages
        ];
        return view('admin.pages',$data);
    }
}
