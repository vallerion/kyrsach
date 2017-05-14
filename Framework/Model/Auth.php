<?php

namespace Framework\Model;

use App\Models\User;
use Framework\Database\DB;
use Framework\Model\Model;

class Auth extends Model {

    protected $table = 'users';

    public function login($email, $password) {
        $user = DB::query("
            select * from {$this->table}
              where 
                email = '{$email}' and password = '{$password}'
        ", User::class);

        return empty($user) ?
                null :
                $user[0];
    }

    public function loginByHash($hash) {
        $user = DB::query("
            select * from {$this->table}
              where 
                \"session\" = '{$hash}'
        ", User::class);
        
        return empty($user) ?
            null :
            $user[0];
    }

    public function saveHash($id, $hash) {
        DB::query("
                update {$this->table} 
                  set \"session\" = '{$hash}'
                      where 
                        id = {$id}
            ");
    }
}

