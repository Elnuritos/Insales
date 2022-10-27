<?php

namespace InSales\Entities;

use Insales\Abstracts\Entity;
use Insales\Interfaces\EntityInterface;
use Insales\library\Insales;
use Insales\Traits\ProductFieldTrait;

class ProductField extends Entity implements EntityInterface
{
    use ProductFieldTrait;

    public function __construct(private Insales $insales){}
}