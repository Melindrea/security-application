<?php
namespace Model;

class Capability extends Base
{
    /**
     * Get roles with a certain capability
     */
    public function roles()
    {
        return $this->belongsToMany('Model\Capability');
    }
}
