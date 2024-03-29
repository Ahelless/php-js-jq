<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/pizza">Управление пиццами</a></li>
                    <li class="active">Добавить новую пиццу</li>
                </ol>
            </div>


            <h4>Добавить новую пиццу</h4>

            <br/>

            <?php if (isset($errors) && is_array($errors)): ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li> - <?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">
                        <p>Название товара</p>
                        <input type="text" name="name">
                        <p>Артикул</p>
                        <input type="text" name="code">
                        <p>Стоимость, $</p>
                        <input type="text" name="price">
                        <p>Ширина(диаметр)</p>
                        <input type="text" name="width">
                        <p>Изображение товара</p>
                        <input type="file" name="image">
                        <p>Детальное описание</p>
                        <textarea name="description"></textarea>
                        <br>
                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" selected="selected">Да</option>
                            <option value="0">Нет</option>
                        </select>
                        <p>Статус</p>
                        <select name="status">
                            <option value="1" selected="selected">Отображается</option>
                            <option value="0">Скрыт</option>
                        </select>
                        <br><br>
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        <br/><br/>

                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

