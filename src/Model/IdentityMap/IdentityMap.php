<?php

namespace Model\IdentityMap;

use Model\Contract\IDomainObject;

class IdentityMap
{
    private $identityMap = [];

    private function getGlobalKey(string $classname, int $id)
    {
        return sprintf('%s.%d', $classname, $id);
    }

    public function add(IDomainObject $obj)
    {
        $key = $this->getGlobalKey(get_class($obj), $obj->getId());

        $this->identityMap[$key] = $obj;
    }

    public function find(string $classname, int $id)
    {
        $key = $this->getGlobalKey($classname, $id);

        if (isset($this->identityMap[$key])) {
            return $this->identityMap[$key];
        }

        return null;
    }


}