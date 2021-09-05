<?php

class Formation extends Model
{
    protected $table = "formation";
    protected $fields = [
        "name" => "TEXT",
        "role" => "TEXT",
        'created_at' => "DATETIME DEFAULT CURRENT_TIMESTAMP"
    ];

}