<?php
namespace Model;

class Role extends Base
{
    /**
     * Set timestamps off
     */
    public $timestamps = false;

    /**
     * Get users with a certain role
     */
    public function users()
    {
        return $this->belongsToMany('Model\User');
    }

    /**
     * Get capabilities for the specific role
     */
    public function capabilities()
    {
        return $this->belongsToMany('Model\Çapability');
    }
}
