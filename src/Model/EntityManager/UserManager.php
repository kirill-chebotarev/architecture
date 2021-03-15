<?php


namespace Model\EntityManager;

use Model\IdentityMap\IdentityMap;
use Model\Repository\User;


class UserManager
{
    private $identityMap;
    public $user;

    public function __construct(User $user, IdentityMap $identityMap)
    {
        $this->user = $user;
        $this->identityMap = $identityMap;
    }

    public function getById(string $domainObjectName, int $objectId)
    {
        $identityMap = new IdentityMap();

        $entity = $this->identityMap->find($domainObjectName, $objectId);

        if ($entity !== null) {
            return $entity;
        }

        $entity = $this->user->getById($objectId);
        $identityMap->add($entity);

        return $entity;
    }

    }