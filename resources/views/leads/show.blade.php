@extends('layouts.crud')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Lead</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('leads.index') }}"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {{ $lead->name }}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Details:</strong>
            {{ $lead->detail }}
        </div>
    </div>
</div>

<p class="text-center text-primary"><small>Tutorial </small></p>
@endsection
