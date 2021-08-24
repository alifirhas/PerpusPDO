<?php
    $title = "Perpus | Buku";
    
    include "./includes/class-autoload.inc.php";
    include "./templates/header.php";
    include "./templates/navigation.php";

    $buku = new Buku();
    $rowBuku = $buku->getBuku($_GET['id']);

?>
    <div class="my-8 mx-auto w-2/4">
        <div class="card bordered w-full">
            <div class="card-body">
                <h2 class="card-title">Update Buku</h2>
                
                <form action="includes/updateBuku.inc.php" method="POST">                
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Judul</span>
                        </label>
                        <input name="judul" id="judul" placeholder="judul"
                            type="text" class="input input-bordered" value="<?= $rowBuku['judul']?>">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Pengarang</span>
                        </label>
                        <input name="pengarang" id="pengarang" placeholder="pengarang"
                            type="text" class="input input-bordered" value="<?= $rowBuku['pengarang']?>">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Stok</span>
                        </label>
                        <input name="stok" id="stok" placeholder="stok"
                            type="number" class="input input-bordered" value="<?= $rowBuku['stok']?>">
                    </div>

                    <input type="hidden" value="<?= $rowBuku['id']?>" name="id">
                    
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