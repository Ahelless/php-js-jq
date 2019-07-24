<?php

/**
 * Контроллер ProductController
 * Товар
 */
class PizzaController
{

    /**
     * Action для страницы просмотра товара
       @param integer $productId <p>id товара</p>
     */
    public function actionView($pizzaId)
    { 

        // Обновляем счетчик просмотров товара
        Pizza::updateNumViewsById($pizzaId);

        // Получаем информацию о товаре
        $pizza = Pizza::getPizzaById($pizzaId);


        // Подключаем вид
        require_once(ROOT . '/views/pizza/view.php');
        return true;
    }

}
