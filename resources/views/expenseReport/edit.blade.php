@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col">
        <h1>Edit Report {{ $report->id}}</h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <a class="btn btn-secondary" href="/expense_reports">Back</a>
    </div>
</div>
<div class="row">
    <div class="col">
        @if($errors->any()) <!-- Verifica si hay errores -->
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li> <!-- Muestra cada mensaje de error -->
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/expense_reports/{{$report->id}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">New Title</label>
                <input type="text" class="form-control" id='title' name='title' placeholder="Type a title" value={{ `old('title')` }}>
            </div>
            <button class='btn btn-primary' type="submit">Submit</button>
        </form>
    </div>
</div>
@endsection