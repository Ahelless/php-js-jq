<?php $pageTitle = 'Личный кабинет'; ?>

<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-4 col-sm-offset-4 padding-right">
                
                <?php if ($result): ?>
                    <p>Пароль успешно изменёнен!</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;"> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Чтобы поменять пароль, заполните следующую форму:</h2>
                        <form action="#" method="post">
                            <label for="old-password">Текущий пароль:</label>
                            <input id="old-password" type="password" name="old-password" placeholder="Текущий пароль" required>
                            
                            <label for="new-password1">Новый пароль:</label>
                            <input id="new-password1" type="password" name="new-password1" placeholder="Новый пароль" required>
                            
                            <label for="new-password2">Потворите новый пароль:</label>
                            <input id="new-password2" type="password" name="new-password2" placeholder="Повторите новый пароль" required>

                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Поменять пароль">
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>
                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>