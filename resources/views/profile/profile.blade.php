@extends('layouts.app')





@section('content')
	<div class="container">
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<p class="text-center">
						{{ $user->name }}
					</p>
				</div>
				<div class="panel-body">

					<img src="{{ ($user->avatar)}}" alt="" width="100px" height="100px" class="center-block img-responsive img-thumbnail" style="border-radius: 25%;"><br><br>
					<h3 class="text-center"><strong>Location:</strong>{{ $user->profile->location }}</h3>
					<p class="text-center">
						@if(Auth::id() == $user->id)
                          
                          <a href="{{ route('profile.edit') }}" class="btn btn-info btn-lg">Edit Profile</a>
                  
						@endif
					</p>
				</div>
			</div>

         @if (Auth::id() !== $user->id)
         	<div class="panel panel-default">
         	<div class="panel-body">
         		<friend :profile_user_id="{{ $user->id }}"></friend>
         	</div>
         </div>
         @endif
         

            
        <div class="panel panel-default">

           	<div class="panel-heading">
					<p class="text-center">
						About Me
					</p>
				</div>
           	<div class="panel-body">
           		{{$user->profile->about}}
           	</div>
        </div>


		</div>
	</div>
@endsection