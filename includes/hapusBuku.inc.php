<?php

include "./class-autoload.inc.php";

$buku = new Buku();

$id = $_POST['id'];

$buku->destroy($id);
