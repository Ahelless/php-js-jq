<?php

/**
 * Контроллер AdminOrderController
 * Управление заказами в админпанели
 */
class CabinetOrdersController
{

    /**
     * Action для страницы "Просмотр заказа"
     */
    public function actionView($id)
    {
        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products_JSON'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        // Получаем список товаров в заказе
        $products = Pizza::getPizzasByIds($productsIds);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/view.php');
        return true;
    }

    /**
     * Action для страницы "Удалить заказ"
     */
    public function actionCancel($id)
    {

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            Order::cancelOrderById($id);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /cabinet/orders");
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/cancel.php');
        return true;
    }

}
