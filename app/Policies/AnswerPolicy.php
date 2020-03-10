<?php

namespace App\Policies;

use App\User;
use App\Answer;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnswerPolicy
{
    use HandlesAuthorization;



    /**
     * Determine whether the user can update the odel= answer.
     *
     * @param  \App\User  $user
     * @param  \App\odel=Answer  $odel=Answer
     * @return mixed
     */
    public function update(User $user, Answer $answer)
    {
      return  $user->id == $answer->user_id;
    }

    /**
     * Determine whether the user can delete the odel= answer.
     *
     * @param  \App\User  $user
     * @param  \App\odel=Answer  $odel=Answer
     * @return mixed
     */
    public function delete(User $user, Answer $answer)
    {
         return  $user->id == $answer->user_id;
    }

    /**
     * Determine whether the user can restore the odel= answer.
     *
     * @param  \App\User  $user
     * @param  \App\odel=Answer  $odel=Answer
     * @return mixed
     */
    public function restore(User $user, Answer $answer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the odel= answer.
     *
     * @param  \App\User  $user
     * @param  \App\odel=Answer  $odel=Answer
     * @return mixed
     */
    public function forceDelete(User $user, Answer $answer)
    {
        //
    }
}
