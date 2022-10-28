<?php

namespace Insales\Entities;

use Insales\Abstracts\Entity;
use Insales\Interfaces\EntityInterface;
use Insales\Library\Gen;
use Insales\Traits\ProductTrait;

class Product extends Entity implements EntityInterface
{
    use ProductTrait;

    public function __construct(private Gen $insales){}
}