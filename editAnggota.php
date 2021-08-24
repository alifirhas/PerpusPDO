<?php
    $title = "Perpus | Buku";
    
    include "./includes/class-autoload.inc.php";
    include "./templates/header.php";
    include "./templates/navigation.php";

    $anggota = new Anggota();
    $rowAnggota = $anggota->getAnggota($_GET['id']);

?>
    <div class="my-8 mx-auto w-2/4">
        <div class="card bordered w-full">
            <div class="card-body">
                <h2 class="card-title">Update Buku</h2>
                
                <form action="includes/updateAnggota.inc.php" method="POST">                
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Nama</span>
                        </label>
                        <input name="nama" id="nama" placeholder="nama"
                            type="text" class="input input-bordered" value="<?= $rowAnggota['nama']?>">
                    </div>

                    <input type="hidden" value="<?= $rowAnggota['id']?>" name="id">
                    
                    <div class="justify-end card-actions">
                        <button type="submit" class="btn btn-secondary">Update</button>
                        <a href="buku.php">
                            <button type="button" class="btn btn-accent">Batal</button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>


<?php

    include "./templates/footer.php";

?>