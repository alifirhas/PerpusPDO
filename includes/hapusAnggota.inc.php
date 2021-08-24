<?php

include "./class-autoload.inc.php";

$anggota = new Anggota();

$id = $_POST['id'];

$anggota->destroy($id);
