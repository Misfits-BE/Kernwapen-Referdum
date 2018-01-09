@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $city->postal }} - {{ $city->name }}
                    <strong><span class="pull-right">(Informatie)</span></strong>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $city->postal }} - {{ $city->name }}
                    <strong><span class="pull-right">(Notities)</span></strong>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="list-group" style="margin-bottom: 0">
                <a href="{{ route('stadsmonitor.index') }}" class="list-group-item">
                    <i class="fa fa-fw fa-arrow-left"></i> Terug naar overzicht
                </a>
            </div>

            <hr style="margin-top: 10px; margin-bottom: 10px;">

            <a href="" class="btn btn-block btn-social btn-facebook">
                <span class="fa fa-facebook"></span>
                Deel op facebook
            </a>
            <a href="" class="btn btn-block btn-social btn-twitter">
                <span class="fa fa-twitter"></span>
                Deel op Twitter
            </a>
        </div>
    </div>
@endsection