<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Page;

class PagesEditController extends Controller
{
    public function execute(Page $page, Request $request){
        if($request->isMethod('post')){
            $messages = [
                'required' => 'Поле :attribute обязательно к заполнению',
                'unique' => 'Поле :attribute должно быть уникальным'
            ];
            $data = $request->except('_token');
            $validate = Validator::make($data,[
                'name' => 'required|max:255',
                'alias'=>'required|max:255|unique:pages,alias,'.$data['id'],//для игнора этой же записи то есть у это записи может остаться тот же alias
                'text' =>'required'
            ],$messages);
            if($validate->fails()){
                return redirect()->route('pagesEdit',['page' => $data['id']])->withErrors($validate);
            }
            if($request->hasFile('images')){
                $file = $request->file('images');
                $file->move(public_path('/assets/img'),$file->getClientOriginalName());
                $data['images'] = $file->getClientOriginalName();
            }
            $string = $data['alias'];
            $string = str_replace(" ","_",$string);
            $data['alias'] = $string;
            $page->fill($data);
            if($page->update()){
                return redirect('admin')->with('status','Страница обновлена');
            }
         }
        else {
            $oldPage = $page->toArray();
            $data = [
                'title' => 'Редактироание страницы - ' . $oldPage['name'],
                'data' => $oldPage
            ];
            return view('admin.page_edit', $data);
        }
    }
}
