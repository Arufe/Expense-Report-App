@extends('layouts.base')

@section('content')
<div class="row">
    <div class="col">
        <h1>Send Report</h1>
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
        <form action="/expense_reports/{{$report->id}}/sendMail" method="post">
            @csrf
            <div class="form-group">
                <label for="sender_email">Sender Email:</label>
                <input type="text" class="form-control" id="sender_email" name="sender_email" placeholder="Type sender email">
            </div>

            <div class="form-group">
                <label for="sender_name">Sender Name:</label>
                <input type="text" class="form-control" id="sender_name" name="sender_name" placeholder="Type sender name">
            </div>
            <button class='btn btn-primary' type="submit">Send mail</button>
        </form>
    </div>
</div>
@endsection