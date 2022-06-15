<?php 

namespace App\Validation;

use App\Models\UsuarioModel;

class UserRules {

    public function validateUser(string $str, string $fields, array $data){
        $model = new UsuarioModel();

        $user = $model->where('USUARIO',$data['email']) 
                         ->first();

        if(!$user) {
            return false;
        }

        return password_verify($data['password'], $user['CONTRASENA']);
    }

    public function validateEmail(string $str, string $fields, array $data) {
        $model = new UsuarioModel();

        $user = $model->where('USUARIO',$data['email']) 
                         ->first();


        if(!$user) {
            return false;
        }

        return true;
    }
}