<?php

namespace App\Database;


use Illuminate\Database\Eloquent\Model;

class Clients extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['client'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['Clients'];

    /**
     * Get all the hubs for the client.
     */
    public function hubs()
    {
        return $this->hasMany('App\Database\Hubs');
    }

    /**
     * Is the client archived?
     */
    public function isArchived()
    {
        if($this->archived)
            return true;
    }
}