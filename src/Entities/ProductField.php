<?php

namespace Insales\Entities;

use Insales\Abstracts\Entity;
use Insales\Interfaces\EntityInterface;
use Insales\Library\Gen;
use Insales\Traits\ProductFieldTrait;

class ProductField extends Entity implements EntityInterface
{
    use ProductFieldTrait;

    public function __construct(private Gen $insales){}
}