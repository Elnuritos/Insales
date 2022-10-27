<?php

namespace InSales\Entities;

use Insales\Abstracts\Entity;
use Insales\Interfaces\EntityInterface;
use Insales\library\Insales;
use Insales\Traits\OrderTrait;

class Order extends Entity implements EntityInterface
{
    use OrderTrait;

    public function __construct(private Insales $insales){}
}