<?php

namespace App\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Serializer\Attribute\Ignore;

#[Entity]
class ChildEntity
{
    #[Id]
    #[Column]
    #[GeneratedValue]
    private int $id;

    #[Ignore]
    public string $ignored = 'ignored';

    public function getId(): int
    {
        return $this->id;
    }
}
