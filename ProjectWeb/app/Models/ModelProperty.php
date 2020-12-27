<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelProperty extends Model{
    protected $table      = 'property';
    protected $primaryKey = 'id';

    protected $allowedFields = ["id", "namaproperty", "kota", "luas", "foto"];
}