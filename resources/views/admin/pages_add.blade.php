@extends('admin.admin')

@section('header')
    @include('admin.header')
@endsection
@section('content')
    <div class="wrapper container-fluid">
        <form action="{{route('pagesAdd')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Заголовок</label>
                <input type="text" class="form-control" id="name" name="name"  value="{{old('name')}}" placeholder="Заголовок">
            </div>
            <div class="form-group">
                <label for="alias">Псевдоним</label>
                <input type="text" class="form-control" id="alias" name="alias"  value="{{old('alias')}}" placeholder="Псевдоним">
            </div>
            <div class="form-group">
                <label for="text">Полный текст</label>
                <textarea class="form-control" value="{{old('text')}}" name="text"></textarea>
            </div>
            <div class="form-group">
                <label class="btn btn-primary" for="images">
                    <input id="images" name="images" type="file">
                    Веберите изображение
                </label>
            </div>
            {{csrf_field()}}
            <button type="submit" class="btn btn-default">Сохранить</button>
        </form>
    </div>
@endsection