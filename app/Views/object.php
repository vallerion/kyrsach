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
        <div class="row">

            <div class="row">
                <div class="col s12 m12 s12">
                    <div class="card small teal lighten-1 white-text">
                        <div class="card-content">
                            <span class="card-title"><?=$object->name?></span>
                            <p><b>Тип:</b> <?=$object->type()->name?></p>
                            <p><b>Формат:</b> <?=$object->format?></p>
                            <p><b>Размер:</b> <?=$object->size?> байт</p>
                            <p><b>Дата создания:</b> <?=date("d.m.Y H:s", strtotime($object->create_at))?></p>
                            <p><b>Авторы:</b></p>
                            <ul class="collection teal-text">
                                <?php foreach ($object->authors() as $author): ?>
                                    <li class="collection-item"><a href="<?=url('/author/' . $author->id)?>"><?="$author->name, роль: $author->role"?></a></li>
                                <?php endforeach; ?>
                            </ul>

                            <a href="<?=empty($object->path) ? '' : url('download/' . $object->id)?>" class="waves-effect waves-light btn blue right"><i class="material-icons left">get_app</i>Скачать</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

<script src="<?=url('assets/js/jquery.js')?>"></script>
<script src="<?=url('assets/js/materialize.min.js')?>"></script>

</body>
</html>