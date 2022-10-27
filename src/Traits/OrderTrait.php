<?php

namespace Insales\Traits;

use Insales\Abstracts\Entity;
use Insales\library\Insales;

trait OrderTrait {

    /**
     * Создание заказа
     * В случае успешного создания заказа возвращает ассоциативный массив созданного заказа
     * В случае неудачи выйдет соответствующее исключение
     * @param array $order Массив заказа в соответствии с документацией
     * @return \Insales\Abstracts\Entity Ответ от сервера
     */
    public function createOrder(array $order) : Entity
    {
        $in=new Insales();
        return $in->executeCreateRequest(
            $in->generateUrl(self::API_URL_ORDERS),
            $order
        );
    }

    /**
     * Редактирование заказа
     * @param int $id
     * @param array $order
     * @return \Insales\Abstracts\Entity
     */
    public function editOrder(int $id, array $order) : Entity
    {
        $in=new Insales();
        return $in->executeUpdateRequest($in->generateUrl(self::API_URL_ORDERS, $id), $order);
    }

    /**
     * Получение списка заказов
     * @param array $params Доступные параметры запроса
     * @return \Insales\Abstracts\Entity
     */
    public function getOrders(array $params = array()) : Entity
    {
        $in=new Insales();
        return $in->executeListRequest($in->generateUrl(self::API_URL_ORDERS), $params);
    }

    /**
     *  Получение заказа
     * @param string|integer $id Идентификатор заказа
     * @return \Insales\Abstracts\Entity
     */
    public function getOrderById(int $id) : Entity
    {
        $in=new Insales();
        return $in->executeGetRequest(
            $in->generateUrl(self::API_URL_ORDERS, $id),
            $id
        );
    }

    /**
     * Получает количество заказов
     * @return \Insales\Abstracts\Entity Количество заказов
     */
    public function getOrdersCount() : Entity
    {
        $in=new Insales();
        $response = $in->request(
            $in::METHOD_GET,
            self::API_URL . self::API_URL_ORDERS . '/count.json'
        );
        return $response;
    }

    /**
     * Удаление заказа по идентификатору
     * @param int $id Идентификатор заказа
     * @return \Insales\Abstracts\Entity
     */
    public function removeOrder(int $id) : Entity
    {
        $in=new Insales();
        return $in->executeRemoveRequest(
            $in->generateUrl(self::API_URL_ORDERS, $id),
            $id
        );
    }

    public function updateOrder(int $id, array $data) : Entity
    {
         $in=new Insales();
        return $in->executeUpdateRequest(
            $in->generateUrl(self::API_URL_ORDERS, $id),
            $data
        );
    }
}