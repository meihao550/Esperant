<?php

namespace App\Policies;

use App\Models\Forum;
use App\Models\User;

class ForumPolicy
{
    /**
     * 投稿者本人のみ更新を許可する。
     */
    public function update(User $user, Forum $forum): bool
    {
        return $user->name === $forum->author;
    }

    /**
     * 投稿者本人のみ削除を許可する。
     */
    public function delete(User $user, Forum $forum): bool
    {
        return $user->name === $forum->author;
    }
}
