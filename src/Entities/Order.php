<?php

namespace Insales\Entities;

use Insales\Abstracts\Entity;
use Insales\Interfaces\EntityInterface;
use Insales\Library\Gen;
use Insales\Traits\OrderTrait;

class Order extends Entity implements EntityInterface
{
    use OrderTrait;

    public function __construct(private Gen $insales){}
}