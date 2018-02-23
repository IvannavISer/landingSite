<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Page;

class PagesAddController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function execute(Request $request){
        $title = "Новая страница";
        $messages = [
            'required' => 'Поле :attribute обязательно к заполнению',
            'unique' => 'Поле :attribute должно быть уникальным'
        ];
        if($request->isMethod('post')){
               $data = $request->except('_token');
            $validate = Validator::make($data,[
                'name' => 'required|max:255',
                'alias'=>'required|unique:pages|max:255',
                'text' =>'required'
            ],$messages);
            if($validate->fails()){
                return redirect()->route('pagesAdd')->withErrors($validate)->withInput();//withInput что бы пользователь заново всё на заполнял
            }
            else{
                if($request->hasFile('images')){
                    $file = $request->file('images');//объект изображение
                    $file->move(public_path('/assets/img'),$file->getClientOriginalName());
                    $data['images'] = $file->getClientOriginalName();//только имя помешаем в ячейку images
                    $page = new Page;
                    $string = $data['alias'];
                    $string = str_replace(" ","_",$string);
                    $data['alias'] = $string;
                    $page->fill($data);
                    $page->save();
                    return redirect('admin')->with('status','Страница добавлена');
                }
            }
        }
        else {
            return view('admin.pages_add',['title'=>$title]);
        }
    }
}
