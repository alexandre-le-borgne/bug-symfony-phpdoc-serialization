<?php

namespace App\Model;

use App\Entity\ChildEntity;
use App\Entity\ParentEntity;

class ParentModelInput
{

    public ChildEntity|ParentEntity $entity;

    /**
     * @var ChildModelInput[]
     */
    public array $children;
}
