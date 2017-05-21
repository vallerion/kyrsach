<?php

namespace App\Models;

use Framework\Database\DB;
use Framework\Model\Model;

class Role extends Model {

    protected $table = 'role';

    public function create(array $values) {
        return DB::query("
            insert into role (
              \"name\"
            ) 
            values(
              '{$values['name']}'
            )
            returning *
        ", static::class);
    }

    public static function search($search) {
        return DB::query("
            select role.*
              from role
            where role.name ilike '%$search%'
        ", static::class);
    }
}