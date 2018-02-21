<div style="margin: 0px 0px 0px 50px;">
    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>№</th>
            <th>Имя</th>
            <th>Псевдоним</th>
            <th>Текст</th>
            <th>Дата Создания</th>
            <th>Удалить</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $k => $page)
            <tr>
                <td>
                    {{$page->id}}
                </td>
                <td>
                    <a href="{{route('pagesEdit',['page'=>$page->id])}}">{{$page->name}}</a>
                </td>
                <td>{{$page->alias}}</td>
                <td>{!!$page->text!!}</td>
                <td>{{$page->created_at}}</td>
                <td>
                    <form action="{{route('pagesEdit',['page'=>$page->id])}}" class="form-horizontal" method="post">
                        {{method_field('DELETE')}}
                        {{csrf_field()}} {{--защита от атак межсайтовых подделок запроса--}}
                        <button type="submit" class="btn btn-danger">Удалить</button>
                     </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p><a class="btn btn-primary btn-lg" href="{{route('pagesAdd')}}" methods="get">ADD new record</a></p>
</div>