@extends('layout')

@section('content')
<div class="container mt-4">
    <h2>States</h2>

    <form action="{{route('states.index')}}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" id="search" placeholder="Search states..." value="{{request('search')}}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form>

    <a href="{{route('cities.create')}}" class="btn btn-success mb-3">Add City</a>
    <a href="{{route('states.create')}}" class="btn btn-success mb-3">Add State</a>
    <a href="{{route('countries.create')}}" class="btn btn-success mb-3">Add Country</a>

    @if($states->count())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>State Name</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($states as $state)
            <tr>
                <td>{{$state->id}}</td>
                <td>{{$state->state_name}}</td>
                <td>{{$state->country->country_name}}</td>
                <td>
                    <a href="{{route('states.edit', $state)}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{route('states.destroy', $state)}}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are your sure?')">Delete</button>
                    </form>
                </td>
            </tr>
                
            @endforeach
        </tbody>
    </table>
    {{$states->links('pagination::bootstrap-5')}}
    @else

    <p>No states found .</p>
        
    @endif
</div>
<script>
    $(document).on('keyup', 'input[name="search"]', function () {
        let query = $(this).val();
        $.ajax({
            url: '/states',
            type: 'GET',
            data: {search: query},
            success: function (data){
                $('tbody').html($(data).find('tbody').html());
            },
        });
    });
</script>
@endsection