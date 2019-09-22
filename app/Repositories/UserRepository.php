<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository
{

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function update($id, array $attributes)
    {
        if (!$attributes['password'])
        {
            unset($attributes['password']);
            unset($attributes['password_confirmation']);
        } else
        {
            $attributes['password'] = Hash::make($attributes['password']);
        }

        return $this->model->find($id)->update($attributes);
    }
}