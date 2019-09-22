<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
//use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                {
                    return [
                        'name' => 'required|string|max:255',
                        'email' => 'required|email|unique:users',
                        'role' => 'required',
                        'password' => 'required|string|min:6|confirmed',
                    ];
                }
            case 'PUT':
            case 'PATCH':
            {
                $user = User::find((int) request()->segment(2));
                return [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email,' . $user->id . ',id',
                    'role' => 'required',
                    'password' => 'sometimes|nullable|min:6|confirmed',
                ];
            }
            default: break;
        }
    }
}
