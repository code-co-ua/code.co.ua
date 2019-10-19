<?php

namespace Domain\Policies;

use App\User;
use Domain\Article\Article;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $article->user_id == $user->id;
    }
}
