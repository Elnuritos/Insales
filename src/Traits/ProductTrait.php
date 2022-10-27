<?php

namespace Insales\Traits;

use Insales\library\Insales;
use Insales\Abstracts\Entity;

/**
 * Trait Product Часть API-клиента, отвечающая за товары
 * @package InSales\Traits
 * @mixin \Insales\Abstracts\Entity
 */
trait ProductTrait {
    /**
     * Создание товара
     * В случае успешного создания товара возвращает ассоциативный массив созданного товара
     * @param array $product Массив созданного товара
     * @return \Insales\Abstracts\Entity
     */
    public function createProduct(array $product) {
        $in=new Insales();
        return $in->executeCreateRequest(
            $this->generateUrl(self::API_URL_PRODUCTS),
            $product
        );
    }

    /**
     * Получение товаров
     * @param array $params Параметры запроса
     * @return \Insales\Abstracts\Entity
     */
    public function getProducts($params = []) {
           $in=new Insales();
        return $in->executeListRequest(
            $this->generateUrl(self::API_URL_PRODUCTS),
            $params
        );
    }

    /**
     * Получение товара по идентификатору
     * @param $id
     * @return \Insales\Abstracts\Entity
     */
    public function getProductById($id) {
        $in=new Insales();
        return $in->executeGetRequest(
            $this->generateUrl(self::API_URL_PRODUCTS, $id),
            $id
        );
    }

    /**
     * Удаление товара по идентификатору
     * @param $id string|integer Идентификатор товара
     * @return \Insales\Abstracts\Entity Результат удаления
     */
    public function removeProduct($id) {
        $in=new Insales();
        return $in->executeRemoveRequest(
            $this->generateUrl(self::API_URL_PRODUCTS, $id),
            $id
        );
    }

    /**
     * Обновление товара
     * @param int $id
     * @param array $data
     * @return Entity
     */
    public function updateProduct(int $id, array $data) : Entity
    {
        $in=new Insales();
        return $in->executeUpdateRequest(
            $this->generateUrl(self::API_URL_PRODUCTS, $id),
            $data
        );
    }

    /**
     * Получение количества товаров
     * @return \Insales\Abstracts\Entity
     */
    public function getProductsCount() {
        $in=new Insales();
        return $in->executeGetRequest(
            $this->generateUrl(self::API_URL_PRODUCTS_COUNT),
            null
        );
    }
}