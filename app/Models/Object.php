<?php

namespace App\Models;

use Framework\Database\DB;
use Framework\Model\Model;

class Object extends Model {

    protected $table = 'object';

    public function top($count = 10) {
        return DB::query("
            select object.id, object.name from (
                select object.id, object.name, rank() over (PARTITION BY object.type_id order by count(download.object_id) desc) as rate
                from object 
                    join download on download.object_id = object.id
                group by object.id, object.name
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
            select author.*
              from author
              join object_author_role on object_author_role.author_id = author.id and object_author_role.object_id = {$this->id}
            group by author.id
        ", Author::class);
    }


    public static function objectGenre($objectId, array $genreIds) {

        $query = "insert into object_genre (object_id, genre_id) values";

        foreach ($genreIds as $key => $genreId) {
            $query .= "('{$objectId}','{$genreId}')";

            if(isset($genreIds[$key + 1]))
                $query .= ',';
        }

        return DB::query($query);
    }

    public function create(array $values) {
        return DB::query("
            insert into object (
              \"name\",
              type_id,
              format,
              path,
              \"size\") 
            values(
              '{$values['name']}',
              '{$values['type_id']}',
              '{$values['format']}',
              '{$values['path']}',
              '{$values['size']}'
            )
            returning *
        ", static::class);
    }

    public static function objectRoleAuthor(array $values) {

        $query = "insert into object_author_role (object_id, author_id, role_id) values";
        
        foreach ($values as $key => $value) {
            $query .= "('{$value['object']}','{$value['author']}','{$value['role']}')";

            if(isset($values[$key + 1]))
                $query .= ',';
        }

        return DB::query($query);
    }

    public static function search($search) {
        return DB::query("
            select object.*
              from object
              join object_genre on object_genre.object_id = object.id
              join genre on genre.id = object_genre.genre_id
            where object.name ilike '%$search%' or
                  genre.name ilike '%$search%'
            group by object.id
        ", Object::class);
    }
}