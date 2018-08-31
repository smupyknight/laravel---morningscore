<?php

namespace App\Http\Controllers\Api\Portal;

use App\Models\User;
use Illuminate\Http\Request;
use MorningTrain\Foundation\Api\Controller;
use MorningTrain\Foundation\Api\Field;
use MorningTrain\Foundation\Api\Traits\PolicyAuthorization;
use App\Support\Validation\CurrentPasswordValidation;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;


class UserController extends Controller
{
    use PolicyAuthorization;
    
    protected $model = User::class;

    protected function fields(Model $model)
    {
        return [
            Field::create('first_name')->validates('string|nullable'),
            Field::create('last_name')->validates('string|nullable'),
            Field::create('email')->validates(function (User $user) {
                return "email|unique:users,email,{$user->id}";
            }),

			Field::create('lang')->validates('string|nullable'),
			Field::create('currency')->validates('alpha|size:3|nullable'),

            Field::create('password')->validates([
                'password' => ['string', 'min:6', 'confirmed', new CurrentPasswordValidation()],
            ])->updates(function (User $user, string $attribute, string $value) {
                $user->password = Hash::make($value);
            }),
        ];
    }
    
    protected function modelResponse(Model $model)
    {
        return $model->only([
            'id',
            'first_name',
            'last_name',
            'email',
			'lang',
			'currency',
        ]);
    }
}

