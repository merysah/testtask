<?php

namespace App\Repositories;

use App\Post;

class PostRepository extends Repository
{

    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }
}