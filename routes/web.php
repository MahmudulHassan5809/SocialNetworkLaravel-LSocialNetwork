<?php

use App\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/hello', function () {
//     return Auth::user()->hello();
// });

// Route::get('/add', function () {
//     return User::find(1)->add_friend(2);
// });

// Route::get('/acc', function () {
//     return User::find(4)->accept_friend(1);
// });

// Route::get('/frnds', function () {
//     return User::find(2)->friends();
// });

// Route::get('/pending', function () {
//     return User::find(1)->pending_friend_requests();
// });

// Route::get('/allfrndid', function () {
//     return User::find(4)->friends_ids();
// });

// Route::get('/isfriend', function () {
//     return User::find(4)->is_friend_with(2);
// });

// Route::get('/pendreqid', function () {
//     return User::find(2)->pending_friend_requests_ids();
// });

// Route::get('/pendreqsent', function () {
//     return User::find(1)->pending_friend_requests_sent();
// });
// Route::get('/pendreqfrom', function () {
//     return User::find(2)->has_pending_friend_request_from(1);
// });
// Route::get('/pendreqsentto', function () {
//     return User::find(2)->has_pending_friend_request_sent_to(1);
// });






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'],function(){
  
  Route::get('/profile/{slug}',[
   
   'uses'=>'ProfileController@index',
   'as'=>'profile'

  ]);

  Route::get('/profile/edit/profile',[
   
   'uses'=>'ProfileController@edit',
   'as'=>'profile.edit'

  ]);

  Route::post('/profile/update/profile',[
   
   'uses'=>'ProfileController@update',
   'as'=>'profile.update'

  ]);

  Route::get('/check_relationship_status/{id}',[
   
   'uses'=>'FriendshipsController@check',
   'as'=>'check'

  ]);

  Route::get('/add_friend/{id}',[
   
   'uses'=>'FriendshipsController@add_friend',
   'as'=>'add_friend'

  ]);

  Route::get('/accept_friend/{id}',[
   
   'uses'=>'FriendshipsController@accept_friend',
   'as'=>'accept_friend'

  ]);

  Route::get('get_unread',function(){
    return Auth::user()->unreadNotifications;
  });

  Route::get('/notifications/',[
   
   'uses'=>'HomeController@notifications',
   'as'=>'notifications'

  ]);

  Route::post('/create/post',[
    'uses' =>'PostsController@store'
    
]);

   Route::get('/feed/',[
    'uses' =>'FeedsController@feed',
    'as'=>'feed'
    
]);

  Route::get('/get_auth_user_data/',function(){
  
  return Auth::user();

  });

 Route::get('/like/{id}',[
    'uses' =>'LikesController@like',
    'as'=>'like'
    
]);

  Route::get('/unlike/{id}',[
    'uses' =>'LikesController@unlike',
    'as'=>'unlike'
    
]);
   


});
