<?php

namespace Insales\Traits;

use Insales\library\Insales;
use Insales\Abstracts\Entity;

/**
 * Trait ProductField Часть API-клиента, отвечающая за поля товаров
 * @package Insales\Traits
 * @mixin \Insales\Abstracts\Entity
 */
trait ProductFieldTrait
{
    /**
     * Создание поля товара
     * @param array $data
     * @return Entity
     */
    public function createProductField(array $data) : Entity
    {
         $in=new Insales();
        return $in->executeCreateRequest(
            $in->generateUrl(self::API_URL_PRODUCT_FIELD),
            $data
        );
    }

    /**
     * Удалить поле товара
     * @param int $id
     * @return Entity
     */
    public function removeProductField(int $id) : Entity
    {
         $in=new Insales();
        return $in->executeRemoveRequest(
            $in->generateUrl(self::API_URL_PRODUCT_FIELD, $id),
            $id
        );
    }

    /**
     * Получение поля товара
     * @param int $id
     * @return Entity
     */
    public function getProductField(int $id) : Entity
    {
         $in=new Insales();
        return $in->executeGetRequest(
            $in->generateUrl(self::API_URL_PRODUCT_FIELD, $id),
            $id
        );
    }

    /**
     * Получение списка полей товара
     * @return Entity
     */
    public function getProductFields() : Entity
    {
         $in=new Insales();
        return $in->executeListRequest(
            $in->generateUrl(self::API_URL_PRODUCT_FIELD)
        );
    }

    /**
     * Обновление поля товара
     * @param int $id
     * @param array $data
     * @return Entity
     */
    public function updateProductField(int $id, array $data) : Entity
    {
         $in=new Insales();
        return $in->executeUpdateRequest(
            $in->generateUrl(self::API_URL_PRODUCT_FIELD, $id),
            $data
        );
    }
}
