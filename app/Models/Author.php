<?php

namespace App\Models;

use Framework\Database\DB;
use Framework\Model\Model;

class Author extends Model {

    protected $table = 'author_view'; // view

    public function top($count = 10) {
        return DB::query("
            with best_authors_loc as (
                select author.id, author.name as author, object.name as object, object_type.name as type,
                (
                    select count(*)
                    from download
                        where download.object_id = object_author_role.object_id
                ) as count_download,
                count(object_author_role.*) as count_role
                from author_view as author
                join object_author_role on author.id = object_author_role.author_id
                join object on object.id = object_author_role.object_id
                join object_type on object_type.id = object.type_id
                group by author.id, author.name, object_author_role.object_id, object.name, object_type.name
            )
            select *
            from best_authors_loc
            limit $count
        ", static::class);
    }

    public function roles() {
        return DB::query("
            select role.name
              from role
              join object_author_role on object_author_role.role_id = role.id and object_author_role.author_id = {$this->id}
            group by object_author_role.author_id, role.name
        ", Role::class);
    }

    public function objects() {
        return DB::query("
            select object.*
              from object
            join object_author_role on object_author_role.object_id = object.id and object_author_role.author_id = {$this->id}
            group by object_author_role.role_id, object.id
        ", Object::class);
    }

}