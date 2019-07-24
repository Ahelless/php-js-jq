<?php $pageTitle = 'Личный кабинет'; ?>

<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h4>Отменить заказ #<?php echo $id; ?></h4>

            <p>Вы действительно хотите отменить этот заказ?</p>
            <form method="post">
                <input type="submit" name="submit" value="Отменить" />
            </form>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>