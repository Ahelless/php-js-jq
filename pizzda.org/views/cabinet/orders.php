<?php $pageTitle = 'Личный кабинет'; ?>

<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h4>История ваших заказов</h4><br>

            <?php if($ordersList): ?>
                <table class="table-bordered table-striped table">
                    <tr>
                        <th>Номер заказа</th>
                        <th>Дата оформления</th>
                        <th>Статус заказа</th>
                        <th></th>
                        <th></th>
                    </tr>
                    <?php foreach ($ordersList as $order): ?>
                        <tr>
                            <td><?php echo $order['id']; ?></td>
                            <td><?php echo $order['date']; ?></td>
                            <td><?php echo Order::getStatusText($order['status']); ?></td>    
                            <td style="text-align: center;">
                                <a href="/cabinet/order/view/<?php echo $order['id']; ?>" title="Подробно"><i class="fa fa-eye"></i></a>
                            </td>
                            <td style="text-align: center;">
                                <?php 
                                if($order['status'] == 5 || $order['status'] == 6) {
                                    echo '<i class="fa fa-times" style="color: #D8D8D8"></i>';
                                } else {
                                    echo '<a href="/cabinet/order/cancel/' . $order['id'] . '" title="Отменить заказ"><i class="fa fa-times"></i></a>';
                                    
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Список заказов пуст, перейдите в <a href="/catalog">каталог товаров</a>, чтобы выбрать товар.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>