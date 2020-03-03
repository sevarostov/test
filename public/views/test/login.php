
<?php include ROOT . '/views/layouts/header.php'; ?>

<style>
        .container-login
        {
            margin: 0;
            padding: 80px;
            position: relative;
            min-height: calc(100vh - 250px);
             }


</style>

<!--Main layout-->
<main>
    <div class="container-login">
        <div class="row">
            <div class="col-sm-12 text-left">
                <?php if (isset($errors) && is_array($errors)): ?>
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li> - <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <div class="signup-form"><!--sign up form--><hr>
                    <h2>Вход на сайт</h2>
                    <br>
                    <form action="#" method="post">
                        <p> Логин: </p>
                        <input type="text" name="text" required="required" />
                        <p> Пароль: </p>
                        <input type="password" name="password" required="required"/>
                        <br>
                        <br>
                        <input type="submit" name="submit" class="btn btn-default" value="Вход" />
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</main>


<?php include ROOT . '/views/layouts/footer.php'; ?>