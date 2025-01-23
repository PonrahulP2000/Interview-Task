@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Countries</h2>
    <form method="GET" action="{{route('countries.index')}}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search countries..." value="{{request('search')}}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <a href="{{route('cities.create')}}" class="btn btn-success mb-3">Add City</a>
    <a href="{{route('states.create')}}" class="btn btn-success mb-3">Add State</a>
    <a href="{{route('countries.create')}}" class="btn btn-success mb-3">Add Country</a>

    @if($countries->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Country Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)

                <tr>
                    <td>{{$country->id}}</td>
                    <td>{{$country->country_name}}</td>
                    <td>
                        <a href="{{ route('countries.edit',$country)}}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('countries.destroy',$country)}}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
        {{$countries->links('pagination::bootstrap-5')}}
        @else
        <p>No countries found .</p>
    @endif
</div>
<script>
    $(document).on('keyup', 'input[name="search"]', function () {
        let query = $(this).val();
        $.ajax({
            url: '/countries',
            type: 'GET',
            data: {search: query},
            success: function (data){
                $('tbody').html($(data).find('tbody').html());
            },
        });
    });
</script>
@endsection
