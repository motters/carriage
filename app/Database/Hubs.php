<?php

namespace App\Database;


use Illuminate\Database\Eloquent\Model;

class Hubs extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'hubs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['carriage_name', 'client_id', 'desc', 'module_configuration', 'api_key', 'api_enc', 'api_user', 'api_pass'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['api_enc', 'api_pass'];


    /**
     * Get the client record associated with the hub.
     */
    public function client()
    {
        return $this->hasOne('App\Database\Clients', 'id', 'client_id');
    }


}