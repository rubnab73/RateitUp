<?php

namespace App\Policies;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TopicPolicy
{
    use HandlesAuthorization;

    public function viewAny(?User $user)
    {
        return true;
    }

    public function view(?User $user, Topic $topic)
    {
        if ($topic->status === 'published') {
            return true;
        }

        if (!$user) {
            return false;
        }

        return $user->id === $topic->user_id || $user->is_admin;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id || $user->is_admin;
    }

    public function delete(User $user, Topic $topic)
    {
        return $user->id === $topic->user_id || $user->is_admin;
    }
}