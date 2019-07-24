<?php $pageTitle = 'Товар '.$pizza['code']; ?>

<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="product-details"><!--product-details-->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="product-information"><!--/product-information-->

                                <?php if ($pizza['is_new']): ?>
                                    <img src="/template/images/product-details/new.jpg" class="newarrival" alt="">
                                <?php endif; ?>

                                <h2><?php echo $pizza['name']; ?></h2>
                                <p><b><i class="fa fa-eye"></i></b> <?php echo $pizza['num_views']; ?></p>
                                <p>Код товара: <?php echo $pizza['code']; ?></p>
                                <p><b>Ширина:</b> <?php echo $pizza['width']; ?> мм</p>
                                <span>
                                    <span>&#8372;<?php echo $pizza['price']; ?></span>
                                    <a href="#" data-id="<?php echo $pizza['id']; ?>"
                                       class="btn btn-default add-to-cart">
                                        <i class="fa fa-shopping-cart"></i>В корзину
                                    </a>
                                </span>
                            </div><!--/product-information-->
                        </div>
                        <div class="col-sm-5">
                            <div class="view-product">
                                <img style="width: 100%;" src="<?php echo Pizza::getImage($pizza['id']); ?>" alt="Pizza">
                            </div>
                        </div>
                    </div>
                    <div class="row">                                
                        <div class="col-sm-12">
                            <br/>
                            <h5>Описание товара</h5>
                            <?php echo $pizza['description']; ?>
                        </div>
                    </div>
                </div><!--/product-details-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>