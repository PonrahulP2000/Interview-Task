@extends('layout')

@section('content')

<div class="container mt-4">
    <h2>Add City</h2>
    <form action="{{route('cities.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="city_name" class="form-label">city Name</label>
            <input type="text" class="form-control" name="city_name" id="city_name" required>
        </div>
        <div class="mb-3">
            <label for="state_id" class="form-label">State</label>
            <select name="state_id" id="state_id" class="form-control" required>
                <option value="">Select a Country</option>
                @foreach ($states as $state)
                    <option value="{{$state->id}}">{{ $state->state_name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{route('cities.index')}}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection