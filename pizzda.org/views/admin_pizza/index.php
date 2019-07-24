<?php include ROOT . '/views/layouts/header_admin.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <br/>

            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="/admin">Админпанель</a></li>
                    <li class="active">Управление пиццами</li>
                </ol>
            </div>

            <a href="/admin/pizza/create" class="btn btn-default back"><i class="fa fa-plus"></i> Добавить пиццу</a>
            
            <h4>Список пицц</h4>

            <br/>

            <table class="table-bordered table-striped table">
                <tr>
                    <th>ID товара</th>
                    <th>Артикул</th>
                    <th>Название товара</th>
                    <th>Цена</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($pizzasList as $pizza): ?>
                    <tr>
                        <td><?php echo $pizza['id']; ?></td>
                        <td><?php echo $pizza['code']; ?></td>
                        <td><?php echo $pizza['name']; ?></td>
                        <td><?php echo $pizza['price']; ?> грн</td>  
                        <td><a href="/admin/pizza/update/<?php echo $pizza['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a></td>
                        <td><a href="/admin/pizza/delete/<?php echo $pizza['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer_admin.php'; ?>

