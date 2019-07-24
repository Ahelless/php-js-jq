<?php $pageTitle = 'Личный кабинет'; ?>

<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row" style="font-size: 20px">

            <h4>Вы авторизованы как  <?php echo $user['name'];?> <?php echo $user['surname'];?>!</h4>
            <ul>
                <li><a href="/cabinet/edit">Редактировать данные</a></li>
                <li><a href="/cabinet/orders">История ваших заказов</a></li>
                <li><a href="/cabinet/password">Изменить пароль</a></li>
                <?php
                    if ($user['role'] == 'admin') {
                        echo '<li><a href="/admin">Админ панель</a></li>';
                    }
                ?>
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>