<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;

#[Entity]
class ParentEntity
{
    #[Id]
    #[Column]
    #[GeneratedValue]
    private int $id;

    #[OneToOne(cascade: ['persist'])]
    private ChildEntity $childEntity;


    public function getId(): int
    {
        return $this->id;
    }

    public function getChildEntity(): ChildEntity
    {
        return $this->childEntity;
    }

    public function setChildEntity(ChildEntity $childEntity): void
    {
        $this->childEntity = $childEntity;
    }


}
