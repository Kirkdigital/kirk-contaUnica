<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class Config_system extends Model
{

    use HasFactory;
    use Notifiable;

    protected $connection = 'tenant';
 
    protected $table ='config_system';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'delete_institution', 'delete_people', 'delete_note', 'delete_note', 
        'delete_financial', 'delete_calendar', 'view_periodo', 'view_dash', 'view_detail','view_resumo_financeiro'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'institution_fk',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

}
