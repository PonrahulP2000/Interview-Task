@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>Cities</h2>

    <form action="{{route('cities.index')}}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" id="search" placeholder="Search countries..." value="{{request('search')}}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <a href="{{route('cities.create')}}" class="btn btn-success mb-3">Add City</a>
    <a href="{{route('states.create')}}" class="btn btn-success mb-3">Add State</a>
    <a href="{{route('countries.create')}}" class="btn btn-success mb-3">Add Country</a>

    @if($cities->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>City Name</th>
                <th>State</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
            <tr>
                <td>{{$city->id}}</td>
                <td>{{$city->city_name}}</td>
                <td>{{$city->state->state_name}}</td>
                <td>
                    <a href="{{route('cities.edit', $city)}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{route('cities.destroy', $city)}}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are your sure?')">Delete</button>
                    </form>
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    {{$cities->links('pagination::bootstrap-5')}}
    @else

    <p>No states found .</p>
        
    @endif
</div>
<script>
    $(document).on('keyup', 'input[name="search"]', function () {
        let query = $(this).val();
        $.ajax({
            url: '/cities',
            type: 'GET',
            data: {search: query},
            success: function (data){
                $('tbody').html($(data).find('tbody').html());
            },
        });
    });
</script>
@endsection