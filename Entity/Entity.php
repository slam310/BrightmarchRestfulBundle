<?php

namespace Brightmarch\Bundle\RestfulBundle\Entity;

abstract class Entity
{

    public function __construct()
    {
    }

    public function enable()
    {
        $this->status = 1;
        return($this);
    }
    
    public function disable()
    {
        $this->status = 0;
        return($this);
    }

    /**
     * Method meant to be overwritten to load specific parameters from an array.
     */
    public function loadFromParameters(array $parameters)
    {
        return($this);
    }

    /**
     * Grab a specific parameter and set it internally.
     */
    public function fetchParameter($key, array $parameters, $member)
    {
        $setter = $this->buildSetter($key);
        if (array_key_exists($key, $parameters) && method_exists($this, $setter)) {
            $this->$setter($parameters[$key]);
        }
        return($this);
    }



    /**
     * Turn a key like billing_fullname to BillingFullname and
     * then create a setter method like setBillingFullname.
     */
    private function buildSetter($key)
    {
        $key = str_replace('_', ' ', $key);
        $key = ucwords($key);
        $key = str_replace(' ', '', $key);

        return(sprintf('set%s', $key));
    }

}
