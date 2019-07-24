<?php

/**
 * Класс Order - модель для работы с заказами
 */
class Order
{

    /**
     * Сохранение заказа 
     * param string $userName <p>Имя</p>
     * param string $userSurname <p>Фамилия</p>
     * param string $userPhone <p>Телефон</p>
     * param string $userComment <p>Комментарий</p>
     * param integer $userId <p>id пользователя</p>
     * param array $products <p>Массив с товарами</p>
     * return boolean <p>Результат выполнения метода</p>
     */
    public static function save($userName, $userSurname, $userPhone, $userComment, $userId, $products)
    {
        // Соединение с БД
        $db = Db::getConnection();
        
        // Текст запроса к БД
        if($userId) {
            $sql_order = "INSERT INTO orders (user_name, user_surname, user_phone, user_comment, user_id, products_JSON)
                          VALUES (:user_name, :user_surname, :user_phone, :user_comment, :user_id, :products)";
        } else {
            $sql_order = "INSERT INTO orders (user_name, user_surname, user_phone, user_comment, products_JSON)
                          VALUES (:user_name, :user_surname, :user_phone, :user_comment, :products)";
        }

        // массив в json кодируем
        $products_json = json_encode($products);

        $result1 = $db->prepare($sql_order);
        $result1->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result1->bindParam(':user_surname', $userSurname, PDO::PARAM_STR);
        $result1->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result1->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        if($userId) $result1->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result1->bindParam(':products', $products_json, PDO::PARAM_STR);

        $result1 = $result1->execute();

        // получаем id только что вставленой записи с заказом
        $id_order = $db->lastInsertId();

        // начало sql запроса для составного ключа
        $sql_orders_products = "INSERT INTO `orders__products` (`order_id`, `product_id`, `count_product`) VALUES ";

        // перебираем значения массива для sql запроса
        foreach ($products as $productId => $count) {
            $sql_orders_products = $sql_orders_products . "('{$id_order}', '{$productId}', '{$count}'), ";
        }

        // Убираем запятую в конце запроса
        $sql_orders_products = rtrim($sql_orders_products, ', ');

        $result2 = $db->prepare($sql_orders_products);
        $result2 = $result2->execute();

        return $result1 || $result2;
    }

    /**
     * Возвращает список заказов
     * @return array <p>Список заказов</p>
     */
    public static function getOrdersList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, user_name, user_surname, user_phone, `date`, status FROM orders ORDER BY id DESC');
        $ordersList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $ordersList[$i]['id'] = $row['id'];
            $ordersList[$i]['user_name'] = $row['user_name'];
            $ordersList[$i]['user_surname'] = $row['user_surname'];
            $ordersList[$i]['user_phone'] = $row['user_phone'];
            $ordersList[$i]['date'] = $row['date'];
            $ordersList[$i]['status'] = $row['status'];
            $i++;
        }
        return $ordersList;
    }

    /**
     * Возвращает текстое пояснение статуса для заказа :<br/>
     * <i>1 - Новый заказ, 2 - В обработке, 3 - Доставляется,
     * 4 - Закрыт, 5 -  заявке на отмену, 6 - Отменён</i>
     * @param integer $status <p>Статус</p>
     * @return string <p>Текстовое пояснение</p>
     */
    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
            case '5':
                return 'В заявке на отмену';
                break;
            case '6':
                return 'Отменён';
                break;
        }
    }

    /**
     * Возвращает заказ с указанным id 
     * @param integer $id <p>id</p>
     * @return array <p>Массив с информацией о заказе</p>
     */
    public static function getOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM orders WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполняем запрос
        $result->execute();

        // Возвращаем данные
        return $result->fetch();
    }

    /**
     * Удаляет заказ с заданным id
     * @param integer $id <p>id заказа</p>
     * return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM orders WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует заказ с заданным id
     * @param integer $id <p>id товара</p>
     * @param string $userName <p>Имя клиента</p>
     * @param string $userPhone <p>Телефон клиента</p>
     * @param string $userComment <p>Комментарий клиента</p>
     * @param string $date <p>Дата оформления</p>
     * @param integer $status <p>Статус <i>(включено "1", выключено "0")</i></p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function updateOrderById($id, $userName, $userSurname, $userPhone, $userComment, $date, $status)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE orders
                SET 
                    user_name = :user_name,
                    user_surname = :user_surname,
                    user_phone = :user_phone,
                    user_comment = :user_comment, 
                    date = :date, 
                    status = :status
                WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_surname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function cancelOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE `orders` SET `status` = '5' WHERE `orders`.`id` = :id";


        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
}
