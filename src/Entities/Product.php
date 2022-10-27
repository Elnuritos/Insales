<?php

namespace InSales\Entities;

use Insales\Abstracts\Entity;
use Insales\Interfaces\EntityInterface;
use Insales\library\Insales;
use Insales\Traits\ProductTrait;

class Product extends Entity implements EntityInterface
{
    use ProductTrait;

    public function __construct(private Insales $insales){}
}