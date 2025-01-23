@extends('layout')

@section('content')

<div class="container mt-4">
    <h2>Add State</h2>
    <form action="{{route('states.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="state_name" class="form-label">State Name</label>
            <input type="text" class="form-control" name="state_name" id="state_name" required>
        </div>
        <div class="mb-3">
            <label for="country_id" class="form-label">Country</label>
            <select name="country_id" id="country_id" class="form-control" required>
                <option value="">Select a Country</option>
                @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{ $country->country_name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{route('states.index')}}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection