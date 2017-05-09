<?php

namespace App\Models;

use Framework\Database\DB;
use Framework\Model\Model;

class Object extends Model {

    protected $table = 'object';

    public function top($count = 10) {
        return DB::query("
            select object.id, object.name from (
                select object.*, rank() over (PARTITION BY object.type_id order by count(download.object_id) desc) as rate
                from object 
                    join download on download.object_id = object.id
                group by object.id
            ) object
            where rate <= {$count}
            order by object.rate desc
        ", static::class);
    }

    public function type() {
        $result = DB::query("
            select * from object_type where id = {$this->type_id}
        ");

        return ! empty($result) ?
            $result[0] :
            null;
    }

    public function authors() {
        return DB::query("
            select author.*, role.name as role
              from author
              join object_author_role on object_author_role.author_id = author.id and object_author_role.object_id = {$this->id}
              join role on role.id = object_author_role.role_id
        ", Author::class);
    }
}