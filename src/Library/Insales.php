<?php

namespace Insales\library;

use Insales\Abstracts\Entity;
use Insales\Exceptions\InValidRequestException;

use Insales\Traits\{
    OrderTrait,
    ProductTrait,
    ProductFieldTrait,
};


class Insales
{
    use
        OrderTrait,
        ProductTrait,
        ProductFieldTrait;
        


    const API_URL_ORDERS = '/admin/orders';
    const API_URL_PRODUCTS = '/admin/products';
    const API_URL_PRODUCTS_COUNT = '/admin/products/count';
    const API_URL_PRODUCT_FIELD = '/admin/product_fields';
    const API_URL_PRODUCT_FIELD_VALUE = '/admin/products/{slug}/product_field_values';
    const API_URL ="https://323f9baffa77dfd407d9ee42731e3d7a:14aab7f0d7a89a0c0aa52dd4d54fc29c@dimaestri.com";
    const METHOD_POST = 'POST';
    const METHOD_GET = 'GET';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';


    public function generateUrl(string $url, $id = null): string
    {
        if ($id === null) {
            $result = self::API_URL . $url . '.json';
        } else {
            $result = self::API_URL . $url . '/' . $id . '.json';
        }
        return $result;
    }


    public function request(string $method, string $url, string $params = '', array $headers = []) : Entity
    {
        $responseHeaders = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if (self::METHOD_POST === $method
            || self::METHOD_PUT === $method
            || self::METHOD_DELETE === $method
            || self::METHOD_GET === $method
        ) {
            if (empty($headers)) {
                $headers[] = 'Content-Type: application/json';
                $headers[] = 'Cache-Control: no-cache';
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        if (self::METHOD_GET === $method && !empty($params)) {
            $url .= '?' . $params;
        }
        if (self::METHOD_POST === $method) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        if (self::METHOD_PUT === $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        if (self::METHOD_DELETE === $method) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        }
        curl_setopt(
            $ch,
            CURLOPT_HEADERFUNCTION,
            function($ch, $header) use (&$responseHeaders) {
                unset($ch);
                if (substr_count($header, ':')){
                    list($key, $value) = explode(':', $header, 2);
                    $responseHeaders[$key] = trim($value);
                } else {
                    $responseHeaders[] = trim($header);
                }
                $responseHeaders = array_filter($responseHeaders);
                return strlen($header);
            }
        );
        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);

        $info = curl_getinfo($ch);
        $errno = curl_errno($ch);
        $error = curl_error($ch);
        curl_close($ch);

        if ($errno) {
            throw new InValidRequestException($error, $errno);
        }
        return new Entity(
            $info['http_code'],
            json_decode($response, true),
            "OK",
            $responseHeaders
        );
    }

    /**
     * Выполнение запроса на добавление сущности
     * @param string $url
     * @param array $data
     * @return Entity
     */
    public function executeCreateRequest(string $url, array $data) : Entity
    {

        $response = $this->request(
            self::METHOD_POST,
            $url,
            json_encode($data)
        );
        if ($response->getHttpCode() != 201) {
            $errorMessage = $response->getData();
            if (is_array($errorMessage)) {
                $errorMessage = current($errorMessage);
                if (isset($errorMessage[0])) {
                    $response->setMessage($errorMessage[0]);
                }
            }
        }
        return $response;
    }

    /**
     * Выполнение запроса на удаление сущности
     * @param string $url
     * @param $id
     * @return Entity
     */
    public function executeRemoveRequest(string $url, $id) : Entity
    {
        $response = $this->request(
            self::METHOD_DELETE,
            $url
        );
        if (404 == $response->getHttpCode()) {
            $response->setMessage("Запись '$id' не найдена.'");
        }
        return $response;
    }

    /**
     * Выполнение запроса на получение списка сущностей
     * @param string $url
     * @param array $params
     * @return Entity
     */
    public function executeListRequest(string $url, array $params = []) : Entity
    {
        $response = $this->request(
            self::METHOD_GET,
            $url,
            http_build_query($params)
        );

        if ($response->getHttpCode() != 200) {
            $errorMessage = $response->getData();
            if (is_array($errorMessage)){
                $errorMessage = current($errorMessage);
                $response->setMessage($errorMessage);
            }
        }
        return $response;
    }

    /**
     * Выполнение запроса на получение сущности
     * @param string $url
     * @param $id
     * @param array $params
     * @return Entity
     */
    public function executeGetRequest(string $url, $id, array $params = []) : Entity
    {
        $response = $this->request(
            self::METHOD_GET,
            $url,
            http_build_query($params)
        );
        if(!$response->getData()) {
            $response->setHttpCode(404);
            $response->setMessage("Запись '$id' не найдена.'");
        }

        return $response;
    }

    /**
     * Выполнение запроса на обновление сущности
     * @param string $url
     * @param array $data
     * @return Entity
     */
    public function executeUpdateRequest(string $url, array $data) : Entity
    {
        $response = $this->request(
            self::METHOD_PUT,
            $url,
            json_encode($data)
        );
        if ($response->getHttpCode() != 200) {
            $errorMessage = $response->getData();
            if (is_array($errorMessage)){
                $errorMessage = current($errorMessage);
                $response->setMessage($errorMessage);
            }
        }
        return $response;
    }
}