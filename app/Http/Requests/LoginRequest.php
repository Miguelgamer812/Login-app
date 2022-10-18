<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Factory as ValidationFactory; //Acá se renombra la clase de la libreria para que no se llame Factory si no que se llame ValidationFactory
/*Como se utiliza ValidationFactory? nosotros vamos a acceder de alguna forma a nuestra 
base dedatos atravez de una solicitud y vamos a comprobar nuestras credenciales vamos a 
ver si estamos ingresando un usuario o un password y de esta manera es que vamos a validar 
que no importa si el usuario ingresa un usuario o un correo electronico
se le permiten estas dos opciones atravez de ese campo.
*/

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //PAra autorizar el uso de esta solicitud se cambia de false a true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required',
        ];
    }

    public function getCredentials(){ //Metodos que vamos a llamar directamente en el controlador
        $username = $this->get('username'); //Con esto estamos tratando de obtener el valor

        if($this->isEmail($username)){
            return [
                'email' => $username,
                'password' => $this->get('password'),
            ];
        }
        return $this->only('username','password');
    }

    public function isEmail($value){
        $factory = $this->container->make(ValidationFactory::class); //Esta es una función que nos va a permitir construir una validación basado en una clase especifica en este caso ValidationFActory
        return $factory->make(['username'=> $value],['username'=>'email'])->fails(); //make devuelve un objeto de tipo validator y validator tiene un metodo que se llama fails(Como esperamos un resultado booleano si la comprovación falla el resultado booleano será contrario al que necesitamos si necesitamos un true nos retornará un false)
        /*Explicación: primero creamos una variable llamada factory el ValidationFactory 
        que es una interfaz que nos permite acceder a un módulo de validación instalado 
        en laravel osea es simplemente decir que queremos instanciar basado en esta clase.
        Por tanto la función isEmail tiene que regresar un valor booleano para saver si el 
        valor es un correo electronico o no para ello lo primero que se hace es retornar factory y asignarle
        el metodo make que espera dos parametros el primero es la asignación de un valor en este caso username es igual a valor
        y lo segundo que son las reglas o reglas que quiero aplicar a mis datos en especifico a username
        por eso creamos otro arreglo en el cual ponemos lo que queremos validar en este caso queremos validar que
        username sea un correo o email */
    }
}
