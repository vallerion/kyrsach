<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <link rel="stylesheet" href="<?=url('assets/css/materialize.css')?>">
    <link rel="stylesheet" href="<?=url('assets/css/app.css')?>">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

<ul id="dropdown1" class="dropdown-content">
    <li><a href="<?=url('objects')?>">Все</a></li>
    <li class="divider"></li>
    <li><a href="<?=url('objects/add')?>">Добавить</a></li>
    <li class="divider"></li>
    <li><a href="<?=url('objects/search')?>">Поиск</a></li>
</ul>

<nav>
    <div class="nav-wrapper teal lighten-1">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li class="waves-effect"><a href="<?=url('/')?>">Главная</a></li>
            <li class="waves-effect"><a href="<?=url('authors')?>">Авторы</a></li>
            <li class="active">
                <a class="dropdown-button waves-effect" href="#!" data-activates="dropdown1">Объекты<i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <?php if(\Framework\App\Auth::check() && \Framework\App\Auth::user()->isAdmin()): ?>
            <li class="waves-effect"><a href="<?=url('users')?>">Пользователи</a></li>
            <?php endif; ?>
        </ul>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <?php if(\Framework\App\Auth::check()): ?>
                <li class="waves-effect"><a href="<?=url('/profile/' . \Framework\App\Auth::user()->id)?>"><?=\Framework\App\Auth::user()->name?></a></li>
                <li class="waves-effect"><a href="<?=url('/logout')?>">Выход</a></li>
            <?php else: ?>
                <li class="waves-effect"><a href="<?=url('/login')?>">Вход</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="col s12">
            <nav>
                <div class="nav-wrapper">
                    <div class="input-field">
                        <input placeholder="Введите поисковый запрос" id="search" type="search" name="search" required>
                        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                        <i class="material-icons">close</i>
                    </div>
                </div>
            </nav>
        </div>

        <div class="row">
            <div class="preloader-col col s12 center-align valign-wrapper" style="display:none; padding: 15px;">
                <div class="preloader-wrapper big active center-block">
                    <div class="spinner-layer spinner-blue-only">
                        <div class="circle-clipper left">
                            <div class="circle"></div>
                        </div><div class="gap-patch">
                            <div class="circle"></div>
                        </div><div class="circle-clipper right">
                            <div class="circle"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="search-result" class="collection">
            </div>

        </div>
    </div>

<script src="<?=url('assets/js/jquery.js')?>"></script>
<script src="<?=url('assets/js/materialize.min.js')?>"></script>
<script src="<?=url('assets/js/app.js')?>"></script>

</body>
</html>