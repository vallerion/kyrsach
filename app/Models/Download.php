<?php

namespace App\Models;

use Framework\Database\DB;
use Framework\Model\Model;

class Download extends Model {

    protected $table = 'download';

    public function create($objectId, $userId) {
        return DB::query("
            insert into {$this->table}(object_id, user_id) values($objectId, $userId)
        ", static::class);
    }

}