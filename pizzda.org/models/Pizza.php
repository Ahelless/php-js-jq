<?php

/**
 * Класс Product - модель для работы с товарами
 */
class Pizza
{

    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 12;

    /**
     * Возвращает массив последних товаров
     * @param type $count [optional] <p>Количество</p>
     * @param type $page [optional] <p>Номер текущей страницы</p>
     * @return array <p>Массив с товарами</p>
     */
    public static function getLatestPizzas($count = self::SHOW_BY_DEFAULT)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT id, name, price FROM pizzas
                WHERE status = '1' ORDER BY id DESC
                LIMIT :count";

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);
        
        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        $i = 0;
        $pizzasList = array();
        while ($row = $result->fetch()) {
            $pizzasList[$i]['id'] = $row['id'];
            $pizzasList[$i]['name'] = $row['name'];
            $pizzasList[$i]['price'] = $row['price'];
            $i++;
        }
        return $pizzasList;
    }

    /**
     * Возвращает продукт с указанным id
     * param integer $id <p>id товара</p>
     * return array <p>Массив с информацией о товаре</p>
     */
    public static function getPizzaById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM pizzas WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();

        // Получение и возврат результатов
        return $result->fetch();
    }

    /**
     * Проверяет заполнена цена или нет
     * return boolean <p>Результат выполнения метода</p>
     */
    public static function emptyPrice($argument)
    {
        if (strlen($argument) > 0) {
            return true;
        }
        return false;
    }

   
    /**
     * Возвращает список товаров с указанными индентификторами
     * param array $idsArray <p>Массив с идентификаторами</p>
     * return array <p>Массив со списком товаров</p>
     */
    public static function getPizzasByIds($idsArray)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Превращаем массив в строку для формирования условия в запросе
        $idsString = implode(',', $idsArray);

        // Текст запроса к БД
        $sql = "SELECT * FROM pizzas WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Получение и возврат результатов
        $i = 0;
        $products = array();
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }
        return $products;
    }

    

    /**
     * Возвращает список товаров
     * return array <p>Массив с товарами</p>
     */
    public static function getPizzasList()
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, code FROM pizzas ORDER BY id ASC');
        $pizzasList = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $pizzasList[$i]['id'] = $row['id'];
            $pizzasList[$i]['name'] = $row['name'];
            $pizzasList[$i]['code'] = $row['code'];
            $pizzasList[$i]['price'] = $row['price'];
            $i++;
        }
        return $pizzasList;
    }

    /**
     * Удаляет товар с указанным id
     * param integer $id <p>id товара</p>
     * return boolean <p>Результат выполнения метода</p>
     */
    public static function deletePizzasById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM pizzas WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Редактирует товар с заданным id
     * param integer $id <p>id товара</p>
     * param array $options <p>Массив с информацей о товаре</p>
     * return boolean <p>Результат выполнения метода</p>
     */
    public static function updatePizzaById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE pizzas
                SET 
                    name = :name, 
                    code = :code, 
                    price = :price, 
                    width = :width,
                    description = :description, 
                    is_new = :is_new, 
                    status = :status
                WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':width', $options['width'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

     /**
     * Обновляем счетчик просмотра товара с заданным id
     * param integer $id <p>id товара</p>
     */
    public static function updateNumViewsById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE `pizzas`
                SET `num_views` = `num_views` + 1
                WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }
    
    /**
     * Добавляет новую пиццу
     * param array $options <p>Массив с информацией о товаре</p>
     * return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createPizza($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO pizzas
                (name, code, price, width, description, is_new, status)
                VALUES
                (:name, :code, :price, :width, :description, :is_new, :status)";


        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':width', $options['width'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }


    /**
     * Возвращает путь к изображению
     * param integer $id
     * return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/pizzas/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

}
