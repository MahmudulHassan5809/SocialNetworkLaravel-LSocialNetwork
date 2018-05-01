@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="text-center panel-heading">Notifications</div>

                <div class="">
                   <ul class="list-group">
                      @foreach($nots as $not)
                        
                        <li class="list-group-item">
                         <strong> {{$not->data['name']}}</strong>   {{$not->data['message']}}
                        </li>
                        
                      @endforeach
                    </ul> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
