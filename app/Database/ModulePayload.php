<?php

namespace App\Database;


use Illuminate\Database\Eloquent\Model;

class ModulePayload extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'module_payload';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['module_id', 'payload'];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['Hubs'];

    /**
     * Get the hub's record associated with the current payload.
     */
    public function Hub()
    {
        return $this->hasOne('App\Database\Hubs');
    }
    
}