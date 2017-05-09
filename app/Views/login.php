<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="<?=url('assets/css/materialize.css')?>">
    <link rel="stylesheet" href="<?=url('assets/css/app.css')?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>


<nav>
    <div class="nav-wrapper teal lighten-1">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li class="waves-effect"><a href="<?=url('/')?>">Главная</a></li>
            <li class="waves-effect"><a href="<?=url('authors')?>">Авторы</a></li>
            <li class="waves-effect"><a href="<?=url('objects')?>">Объекты</a></li>
            <li class="waves-effect"><a href="<?=url('users')?>">Пользователи</a></li>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="row valign-wrapper">

            <div class="col s6 center-block">
                <form action="<?=url('login')?>" method="post">
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" required>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" name="password" required>
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 center-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Войти
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

<script src="<?=url('assets/js/jquery.js')?>"></script>
<script src="<?=url('assets/js/materialize.min.js')?>"></script>

</body>
</html>