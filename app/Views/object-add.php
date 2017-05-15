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
            <div class="col l8 s12 offset-l2 z-depth-1 grey lighten-4">

                <form enctype="multipart/form-data" class="col s12" method="post" action="<?=url('objects/add')?>">

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate' type='text' name='name' id='name' required />
                            <label for='name'>Название</label>
                        </div>
                    </div>

                    <div class="input-field col s12">
                        <select name="type" required>
                            <option value="" disabled selected>Выберите тип объекта</option>
                            <?php foreach ($types as $type): ?>
                                <option value="<?=$type->id?>"><?=$type->name?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Тип</label>
                    </div>

                    <div class="input-field col s12">
                        <select name="genre[]" required multiple>
                            <option value="" disabled selected>Выберите жанр объекта</option>
                            <?php foreach ($genres as $genre): ?>
                                <option value="<?=$genre->id?>"><?=$genre->name?></option>
                            <?php endforeach; ?>
                        </select>
                        <label>Жанр</label>
                    </div>

                    <div class="col s12">
                        <div class="input-field col l5 s11">
                            <select name="author[]">
                                <option value="" disabled selected>Выберите автора объекта</option>
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?=$author->id?>"><?=$author->name?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Автор</label>
                        </div>
                        <div class="input-field col l6 s11">
                            <select name="role[0][]" multiple>
                                <option value="" disabled selected>Роли этого автора</option>
                                <?php foreach ($roles as $role): ?>
                                    <option value="<?=$role->id?>"><?=$role->name?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>Роли</label>
                        </div>
                    </div>

                    <div class="file-field input-field col s12">
                        <div class="btn">
                            <span>File</span>
                            <input name="file" type="file" required>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                    </div>

                    <br />
                    <center>
                        <div class='row'>
                            <button type='submit' class='col s12 btn btn-large waves-effect teal lighten-1'>Добавить</button>
                        </div>
                    </center>

                </form>
                
            </div>
        </div>
    </div>

<script src="<?=url('assets/js/jquery.js')?>"></script>
<script src="<?=url('assets/js/materialize.min.js')?>"></script>
<script src="<?=url('assets/js/app.js')?>"></script>

</body>
</html>