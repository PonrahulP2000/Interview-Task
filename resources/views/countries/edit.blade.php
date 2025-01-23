@extends('layout')

@section('content')

<div class="container mt-4">
    <h2>Edit Country</h2>
    <form action="{{ route('countries.update',$country)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="country_name" class="form-label">Country Name</label>
            <input type="text" class="form-control" name="country_name" id="country_name" value="{{$country->country_name}}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{route('countries.index')}}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection