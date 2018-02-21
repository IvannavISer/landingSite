@extends('admin.admin')
@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{route('pagesEdit',['page'=>$data['id']])}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{$data['id']}}">
            <div class="form-group">
                <label for="name">Заголовок</label>
                <input type="text" class="form-control" id="name" name="name"  value="{{$data['name']}}" placeholder="Заголовок">
            </div>
            <div class="form-group">
                <label for="alias">Псевдоним</label>
                <input type="text" class="form-control" id="alias" name="alias"  value="{{$data['alias']}}" placeholder="Псевдоним">
            </div>
            <div class="form-group">
                <label for="text">Полный текст</label>
                <textarea class="form-control" name="text">{{$data['text']}}</textarea>
            </div>
            <div class="form-group">
                <p>Ваше изображение</p>
                  <img src= {{asset('assets/img/'.$data['images'])}}  alt=""/>
                </label>
            </div>
            <div class="form-group">
                <input id="images" name="images" type="file">
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">Сохранить</button>
        </form>
    </div>
@endsection