<?php

namespace App\Traits;
use App\Friendship;
use App\User;

trait Friendable
{
   
   /**
    * This function for add friend
    */
  public function add_friend($user_req_id)
   {
      if ($this->id == $user_req_id)
       {
         return 0;
       }

       if ($this->is_friend_with($user_req_id) === 1)
       {
         return "Already Friends";
       }

      if ($this->has_pending_friend_request_sent_to($user_req_id)==1)
      {
           return "Already Sent Friend Request";
      }

      if ($this->has_pending_friend_request_from($user_req_id)==1)
      {
        return $this->accept_friend($user_req_id);
      }
      $friendship = Friendship::create([
        
          'requester' => $this->id,
          'user_requested' => $user_req_id
      ]);

      if ($friendship)
      {
           
           //return response()->json($friendship,200);
           return 1;
      }else
      {

         //return response()->json('fail',501);
        return 0;
      }
   }
   /**
    * End of addfriend function
    */


   public function accept_friend($requester)
   {
     if ($this->has_pending_friend_request_from($requester) === 0)
     {
       return 0;
     }
     $friendship = Friendship::where('requester',$requester)->where('user_requested',$this->id)->first();

     if ($friendship)
     {
      
      $friendship->update([
           'status' => 1
      ]);

      //return response()->json('Ok',200);
      return 1;
     }else
     {
      //return response()->json('fail',501);
      return 0;
     }

   }

  
  public function friends()
  {
    $friends = array();

    $f1 = Friendship::where('status',1)
                     ->where('requester',$this->id)
                     ->get();

    foreach ($f1 as $friendship):

      array_push($friends,User::find($friendship->user_requested));

    endforeach;

    $friends2 = array();

    $f2 = Friendship::where('status',1)
                     ->where('user_requested',$this->id)
                     ->get();

    foreach ($f2 as $friendship):

      array_push($friends2,User::find($friendship->requester));

    endforeach;

    return array_merge($friends,$friends2);
                                      
  }


  /**
   * check Pending request
   * All The person that sent request me
   * i Did not accept 
   */
  public function pending_friend_requests()
  {
     $users = array();

     $friendships = Friendship::where('status',0)
                              ->where('user_requested',$this->id)
                              ->get();

    foreach ($friendships as $friendship):
    
         array_push($users, User::find($friendship->requester));

    endforeach;

    return $users;
    
  }
  /**
   * End of this pending_friend_requests()
   */

  

  public function friends_ids()
   {
    return collect($this->friends())->pluck('id')->toArray();
   }

  


  public function is_friend_with($user_id)
  {
    if (in_array($user_id, $this->friends_ids()))
    {
        
        //return response()->json('true',200);
      return 1;
    }else
    {
       //return response()->json('flase',200);
       return 0;
    }
  }


  /**
   * Get all the pending requests id.
   * all request you get 
   */
  public function pending_friend_requests_ids()
  {
    return collect($this->pending_friend_requests())->pluck('id')->toArray();
   }
   /**
   * End of this pending_friend_requests_ids()
   */

  
  /**
   * All the Request I sent 
   * return the person i sent the request
   */
  public function pending_friend_requests_sent()
  {
     $users = array();

     $friendships = Friendship::where('status',0)
                              ->where('requester',$this->id)
                              ->get();

    foreach ($friendships as $friendship):
    
         array_push($users, User::find($friendship->user_requested));

    endforeach;

    return $users;
  }
  /**
   * End of this pending_friend_requests_sent()
   */

  

  public function pending_friend_requests_sent_ids()
  {
    return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
  }

  
  /**
   * Check The user get pending request from 
   * which person
   * 
   */
  public function has_pending_friend_request_from($user_id)
  {
    if (in_array($user_id, $this->pending_friend_requests_ids())) {
        //return response()->json('true',200);
        return 1;
    }
    else{
      //return response()->json('false',200);
      return 0;
    }
  }
  /**
   * End of this has_pending_friend_request_from()
   */

  


  /**
   *this function return which person 
   *I send request that is pending
   */
  public function has_pending_friend_request_sent_to($user_id)
  {
     if (in_array($user_id, $this->pending_friend_requests_sent_ids())) {
           return 1;
        }
      else{
        return 0;
      }
  }




}