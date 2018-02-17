<?php

namespace App\Http\Controllers;

use App\Mail\MailClass;
use App\Page;
use App\People;
use App\Portfolio;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function execute(Request $request){
            $result = 0;
//        $peoples = People::take(3)->get();
//        $portfolios = Portfolio::get(array('name','filter','images'));
//        $services = Service::where('id','<',20);
        if($request->isMethod('post')){
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'email' => 'Поле :attribute  должно соответсвовать email'
            ];
            $this->validate($request,[
                'name'=>'required|max:255',
                'email'=>'required|email',
                'text'=>'required'
            ],$messages);
            $data = $request->all();
         $result = Mail::to('admin@mail.ru')->send(new MailClass($data));
        }
        $tags = DB::table('portfolios')->distinct()->pluck('filter')->all();
        //dd($tags);
        $pages = Page::all();
        $peoples = People::all();
        $portfolios = Portfolio::all();
        $services = Service::all();
        $menu = array();
        foreach ($pages as $page){
            $item = array('title'=>$page->name,'alias'=>$page->alias);
            array_push($menu,$item);
        }
        $item = array('title'=>'Services','alias'=>'service');
        array_push($menu,$item);
        $item = array('title'=>'Portfolio','alias'=>'Portfolio');
        array_push($menu,$item);
        $item = array('title'=>'Clients','alias'=>'clients');
        array_push($menu,$item);
        $item = array('title'=>'Team','alias'=>'team');
        array_push($menu,$item);
        $item = array('title'=>'Contact','alias'=>'contact');
        array_push($menu,$item);

        if($result){
            return view('site.index', array(
                'menu' => $menu,
                'pages' => $pages,
                'peoples' => $peoples,
                'portfolios' => $portfolios,
                'services' => $services
            ))->with('status','Email sent');
        }
        else {
            return view('site.index', array(
                'menu' => $menu,
                'pages' => $pages,
                'peoples' => $peoples,
                'portfolios' => $portfolios,
                'services' => $services,
                'tags' => $tags
            ));
        }
    }
}
