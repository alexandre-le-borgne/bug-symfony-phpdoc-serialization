<?php

namespace App\Controller;

use App\Entity\ChildEntity;
use App\Entity\ParentEntity;
use App\Model\ChildModelInput;
use App\Model\ExampleModel;
use App\Model\ParentModelInput;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[AsController]
readonly class IndexController
{
    public function __construct(private SerializerInterface $serializer, private EntityManagerInterface $doctrine)
    {
    }

    #[Route('/')]
    public function __invoke()
    {
        /**
         * Was used to initialize the db:
         *
         * $parent = new ParentEntity();
         * $child = new ChildEntity();
         * $parent->setChildEntity($child);
         * $this->doctrine->persist($parent);
         * $this->doctrine->flush();
         * die;
         */

        // Expect a ParentModelInput with a property $children containing two instance of ChildModelInput
        // Requires "phpdocumentor/reflection-docblock"
        dump($this->serializer->denormalize([
            'children' => [[
                'id'=> 1
            ], [
                'id' => 2
            ]]
        ], ParentModelInput::class, 'json')); // <- It works


        $parent = $this->doctrine->find(ParentEntity::class, 1);

        $model = new ExampleModel();
        // Trying to serialize an object containing a proxy from doctrine
        $model->childEntity = $parent->getChildEntity();

        dump($model);
        dump($this->serializer->normalize($model)); // <- It doesn't work
        // User Notice: Undefined property: Proxies\__CG__\App\Entity\ChildEntity::$lazyObjectState
        // in /home/.../bug-symfony-phpdoc-serialization/vendor/symfony/property-access/PropertyAccessor.php on line 408

        // But it works if you remove the property "$ignored" src/Entity/ChildEntity.php
        die;
    }

}
