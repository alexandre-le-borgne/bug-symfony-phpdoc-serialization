<?php

namespace App\Model;

use App\Entity\ChildEntity;
use App\Entity\ParentEntity;

class ChildModelInput
{
    public ChildEntity|ParentEntity $entity;

    public function __construct(public int $id)
    {

    }
}
