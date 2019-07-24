<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li><a href="/admin/pizza">Управление пиццами</a></li>
                    <li class="active">Редактировать товар</li>
                </ol>
            </div>


            <h4>Редактировать пиццу #<?php echo $id; ?></h4>

            <br/>

            <div class="col-lg-4">
                <div class="login-form">
                    <form action="#" method="post" enctype="multipart/form-data">

                        <p>Название пиццы</p>
                        <input type="text" name="name" value="<?php echo $pizza['name']; ?>">

                        <p>Артикул</p>
                        <input type="text" name="code" value="<?php echo $pizza['code']; ?>">

                        <p>Стоимость, $</p>
                        <input type="text" name="price" value="<?php echo $pizza['price']; ?>">

                        <p>Ширина, мм</p>
                        <input type="text" name="width" value="<?php echo $pizza['width']; ?>">

                        <p>Изображение товара</p>
                        <img src="<?php echo Pizza::getImage($pizza['id']); ?>" width="200" alt="" />
                        <input type="file" name="image" placeholder="" value="<?php echo $pizza['image']; ?>">

                        <p>Детальное описание</p>
                        <textarea name="description"><?php echo $pizza['description']; ?></textarea>
                        
                        <br/><br/>

                        <p>Новинка</p>
                        <select name="is_new">
                            <option value="1" <?php if ($pizza['is_new'] == 1) echo ' selected="selected"'; ?>>Да</option>
                            <option value="0" <?php if ($pizza['is_new'] == 0) echo ' selected="selected"'; ?>>Нет</option>
                        </select>
                        
                        <br/><br/>

                        <p>Статус</p>
                        <select name="status">
                            <option value="1" <?php if ($pizza['status'] == 1) echo ' selected="selected"'; ?>>Отображается</option>
                            <option value="0" <?php if ($pizza['status'] == 0) echo ' selected="selected"'; ?>>Скрыт</option>
                        </select>
                        
                        <br/><br/>
                        
                        <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        
                        <br/><br/>
                        
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

