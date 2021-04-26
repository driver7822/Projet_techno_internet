<?php

if (!isset($_SESSION['admin'])) {
    ?>
    <br>
    <div class="alert alert-danger" role="alert">
        Accès réservé
    </div>

    <?php
    session_destroy();
    ?>
        <meta http-equiv="refresh": content="2;URL=../index.php">

    <?php
}
