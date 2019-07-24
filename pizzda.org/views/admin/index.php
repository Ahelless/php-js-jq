<?php $pageTitle = 'Админ панель'; ?>

<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">
            
            <br>
            <h4>Добрый день, администратор!</h4>
            
            <br>
            <p>Вам доступны такие возможности:</p>
            
            <br>
            <ul>
                <li><a href="/admin/pizza">Управление пиццами</a></li>
                <li><a href="/admin/order">Управление заказами</a></li>
            </ul>
            
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

