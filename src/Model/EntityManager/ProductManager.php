<?php


namespace Model\EntityManager;

use Model\IdentityMap\IdentityMap;
use Model\Repository\Product;


class ProductManager
{
    private $identityMap;
    public $product;

    public function __construct(Product $product, IdentityMap $identityMap)
    {
        $this->product = $product;
        $this->identityMap = $identityMap;
    }

    public function search(string $domainObjectName, array $objectIdArray)
    {
        $identityMap = new IdentityMap();
        $entityArr = [];
        $objectIdsNotFound = [];

        foreach ($objectIdArray as $objectId) {
            $entity = $this->identityMap->find($domainObjectName, $objectId);

            if ($entity !== null) {
                $entityArr[] = $entity;
            } else {
                $objectIdsNotFound[] = $objectId;
            }
        }

        $entityArrOthers = $this->product->search($domainObjectName, [$objectIdsNotFound]);
        $entityAll = array_merge($entityArr,$entityArrOthers) ;

        foreach ($entityAll as $entity) {
            $identityMap->add($entity);
        }

        return $entityAll;
    }

}