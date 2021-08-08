<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $connection = 'tenant';
    public $table = 'email_template';
    
}
