@extends('layout')

@section('content')

<div class="container mt-4">
    <h2>Add Country</h2>
    <form action="{{ route('countries.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="country_name" class="form-label">Country Name</label>
            <input type="text" class="form-control" name="country_name" id="country_name" required>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{route('countries.index')}}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection