<?php require 'app/views/layouts/header.tlp.php';?>
    <body>
    <div class="wrapper">
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a class="navbar-brand" href="/">LRS</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <?php if (isset($_SESSION["auth"])): ?><div class="collapse navbar-collapse w-100 order-1 order-md-0 dual-collapse2" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Главная<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/lrs/view/update">Добавить</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/users">Пользователи</a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
                <div class="navbar-collapse collapse w-100 order-2 dual-collapse2">
                    <ul class="navbar-nav ml-auto">
                        <?php if (isset($_SESSION["auth"])): ?>
                            <li class="nav-item float-right">
                                <form action="<?= route('user_exit'); ?>" method="post">
                                    <button type="submit" name="exit" class="btn btn-danger">Выход</button>
                                </form>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </nav>
        </header>
        <main>
            <?php
            if(isset($_SESSION['errors'])) {
                echo "<div class='alert alert-danger'>";
                foreach($_SESSION['errors'] as $value) {
                    echo "$value";
                    echo '<br>';
                }
                echo "</div>";
            }
            ?>
            <?=$content;?>
        </main>
    </div>
    </body>
<?php require 'app/views/layouts/footer.tlp.php';?>