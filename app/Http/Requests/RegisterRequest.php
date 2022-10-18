<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //Se cambia a true para que el usuario tenga la autorización de continuar con el proceso
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username', //Si encuentra en la base de datos un nombre igual descarta la solicitud
            'password' => 'required|min:8', //Que el campo password tenga minimo 8 datos
            'password_confirmation' => 'required|same:password', //Que el campo password_confirmación tenga que ser igual a password
        ];
    }
}
