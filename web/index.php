<?php

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpFoundation\Request;
use Model\EntityManager\UserManager;
use Model\Repository\User;
use Model\EntityManager\ProductManager;
use Model\Repository\Product;
use Model\IdentityMap\IdentityMap;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$request = Request::createFromGlobals();
$containerBuilder = new ContainerBuilder();

Framework\Registry::addContainer($containerBuilder);

$response = (new Kernel($containerBuilder))->handle($request);
$response->send();

$userManager = new UserManager(
    new User(),
    new IdentityMap()
);

$user = $userManager->getById(User::class, 1);

$productManager = new ProductManager(
    new Product(),
    new IdentityMap()
);

$product = $productManager->search(Product::class, [1,2,3]);
