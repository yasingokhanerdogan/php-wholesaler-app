<?php

namespace App\Models;

use Core\Model;

class PasswordAuthCodes extends Model{

    protected $table = "password_auth_codes";

    public const UPDATED_AT = false;
}