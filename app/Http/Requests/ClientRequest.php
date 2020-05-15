<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() 
    {
        return [
             'nom' => 'required|min:3|max:15',
             'prenom' => 'required|min:3|max:15',
             'login' => 'required',
             'email' => 'required',
             'adresse' => 'required',
             'motdepasse'=>'required|regex:((?=.*\d)(?=.*[a-z])(?=.*[A-Z]))|min:8'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [

            //cheking  first_name 
            'nom.required'      => 'Le Nom est obligatoire !',
            'nom.min'           => 'le Nom doit contenir au minimum 3 caracteres',
            'nom.max'           =>'le Nom doit contenir au maximum 15 caracteres',
            //checking last_name
            'prenom.required'   => 'Le Prénom est obligatoire !',
            'prenom.min'        => 'le Prénom doit contenir au minimum 3 caracteres !',
            'prenom.max'        =>'le Prénom doit contenir au maximum 15 caracteres !',
            //checking_Login
            'login.required'    => 'Le Login est obligatoire !',
            //checking Email
            'email.required'    =>'Veuillez entrer votre Email ! ',
            //checking address field
            'adresse.required'  =>'Veuillez entrer votre adresse !',
            //checking password
            'motdepasse.required'=> 'Veuillez entrer le mot de passe !',
            'motdepasse.min'     =>     'Le mot de passe doit etre contenir au minmum 8 caracteres',
            'motdepasse.regex'   =>   'Le mot de passe doit contenir au mois une lettre Maj et Min et un nombre !',

            



            
            



       
        ];
    }
}
