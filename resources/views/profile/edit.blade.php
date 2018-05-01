@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Your Profile</div>

                <div class="panel-body">
                    <form action="{{ route('profile.update') }}" method="POST" role="form" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="form-group">
                            <label for="avatar">Upload Avatar</label>
                            <input type="file" name="avatar" class="" accept="image/*">
                        </div>
                        
                    
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" class="form-control" name="location" value="{{$info->location}}" id="" placeholder="Location">
                        </div>

                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea name="about" id="about" class="form-control">{{$info->about}}</textarea>
                        </div>
                    
                        
                    
                        
                        <div class="form-group">
                          
                               <button type="submit" class="btn btn-primary btn-lg form-control">Edit</button>
                         
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
