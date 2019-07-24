<?php $pageTitle = 'Личный кабинет'; ?>

<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Данные отредактированы!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;"> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Редактирование данных</h2>
                        <form action="#" method="post">
                            <label for="name">Имя:</label>
                            <input id="name" type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>">
                            
                            <label for="surname">Фамилия:</label>
                            <input id="surname" type="text" name="surname" placeholder="Фамилия" value="<?php echo $surname; ?>">
                            
                            <label for="phone">Телефон:</label>
                            <input id="phone" type="phone" name="phone" placeholder="Телефон" value="<?php echo $phone; ?>">

                            <label for="birthday">День рождения:</label>
                            <input id="birthday" type="date" name="birthday" placeholder="День рождения" value="<?php echo date('Y-m-d', strtotime($birthday)) ?>">
                            
                            <label for="country">Страна:</label>
                            <input id="country" type="text" name="country" placeholder="Страна" value="<?php echo $country; ?>">
                            
                            <label for="city">Город:</label>
                            <input id="city" type="text" name="city" placeholder="Город" value="<?php echo $city; ?>"> 

                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Сохранить">
                        </form>
                    </div><!--/sign up form-->
                <!-- if($phone == 0) { echo 'Не указан'; } else { echo $phone;} -->
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>