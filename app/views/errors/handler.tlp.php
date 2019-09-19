<?php require '../app/views/layouts/header.tlp.php'; ?>
    <body>
        <div class="wrapper">
            <main>
                <?php
                if(isset($errors)) {
                    echo "<div class='alert alert-danger'>";
                    foreach($errors as $value) {
                        echo "$value";
                        echo '<br>';
                    }
                    echo "</div>";
                }
                ?>
            </main>
        </div>
    </body>
</html>