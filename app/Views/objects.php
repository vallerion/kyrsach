<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="<?=url('assets/css/materialize.css')?>">
    <link rel="stylesheet" href="<?=url('assets/css/app.css')?>">
</head>
<body>


<nav>
    <div class="nav-wrapper teal lighten-1">
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li class="waves-effect"><a href="<?=url('/')?>">Главная</a></li>
            <li class="waves-effect"><a href="<?=url('authors')?>">Авторы</a></li>
            <li class="waves-effect active"><a href="<?=url('objects')?>">Объекты</a></li>
            <li class="waves-effect"><a href="<?=url('users')?>">Пользователи</a></li>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="row">
            <div class="col s4">

                <label class="label-top">Все объекты</label>
                <div class="collection">
                    <?php foreach ($objects as $object): ?>
                    <a href="<?=url("object/{$object->id}")?>" class="collection-item"><?=$object->name?></a>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

<script src="<?=url('assets/js/jquery.js')?>"></script>
<script src="<?=url('assets/js/materialize.min.js')?>"></script>

</body>
</html>