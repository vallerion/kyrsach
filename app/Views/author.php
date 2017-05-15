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
            <li class="waves-effect active"><a href="<?=url('authors')?>">Авторы</a></li>
            <li class="">
                <a class="dropdown-button waves-effect" href="#!" data-activates="dropdown1">Объекты<i class="material-icons right">arrow_drop_down</i></a>
            </li>
            <li class="waves-effect"><a href="<?=url('users')?>">Пользователи</a></li>
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
        <div class="row">
            <div class="col s12 m12 s12">
                <div class="card teal lighten-1 white-text">
                    <div class="card-content">
                        <span class="card-title"><?=$author->name?></span>
                        <p><b>Возраст:</b> <?=$author->age?></p>
                        <p><b>Дата регистрации:</b> <?=date("d.m.Y H:s", strtotime($author->create_at))?></p>
                        <p><b>Объекты:</b></p>
                        <ul class="collection teal-text">
                            <?php foreach ($author->objects() as $object): ?>
                                <li class="collection-item">
                                    <a href="<?=url('/object/' . $object->id)?>"><?=$object->name?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?=url('assets/js/jquery.js')?>"></script>
<script src="<?=url('assets/js/materialize.min.js')?>"></script>
<script src="<?=url('assets/js/app.js')?>"></script>

</body>
</html>