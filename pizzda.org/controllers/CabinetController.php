<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }
    
    /**
     * Action для страницы "Заказы пользователя"
     */
    public function actionOrders()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем список заказов
        $ordersList = User::getOrdersListOfUser($userId);

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/orders.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $name = $user['name'];
        $surname = $user['surname'];
        $phone = $user['user_phone'];
        $birthday = $user['user_birthday'];
        $country = $user['user_country'];
        $city = $user['user_city'];


        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $phone = $_POST['phone'];
            $birthday = $_POST['birthday'];
            $country = $_POST['country'];
            $city = $_POST['city'];

            // Флаг ошибок
            $errors = false;

            // Валидируем значения
            if (!User::checkMinTwoLetters($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkMinTwoLetters($surname)) {
                $errors[] = 'Фамилия не должна быть короче 2-х символов';
            }
            if (!User::checkPhone($phone)) {
                $errors[] = 'Телефон в неправальном формате';
            }
            if (!User::checkMinTwoLetters($country)) {
                $errors[] = 'Название страны не должно быть короче 2-х символов';
            }
            if (!User::checkMinTwoLetters($city)) {
                $errors[] = 'Название города не должно быть короче 2-х символов';
            }

            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::edit($userId, $name, $surname, $phone, $birthday, $country, $city);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/edit.php');
        return true;
    }

    /**
     * Action для страницы "Поменять пароль"
     */
    public function actionPassword()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        // Заполняем переменные для полей формы
        $actualPassword = $user['password'];

        // Флаг результата
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы редактирования
            $inputActualPassowrd = $_POST['old-password'];
            $inputNewPassword1 = $_POST['new-password1'];
            $inputNewPassword2 = $_POST['new-password2'];
            
            // Флаг ошибок
            $errors = false;
            
            // Валидируем значения
            if(!($actualPassword == $inputActualPassowrd)) {
                $errors[] = 'Текущий пароль не верен';
            }
            if(!User::checkPassword($inputNewPassword1) || !User::checkPassword($inputNewPassword2)) {
                $errors[] = 'Новый пароль должен быть не менее 6 символов';
            }
            if(!User::checkNewPasswords($inputNewPassword1, $inputNewPassword2)) {
                $errors[] = 'Новые пароли не совпадают';
            }
            if ($errors == false) {
                // Если ошибок нет, сохраняет изменения профиля
                $result = User::editPassword($userId, $inputNewPassword2);
            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/password.php');
        return true;
    }
}
