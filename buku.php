<?php
    $title = "Perpus | Buku";
    
    include "./includes/class-autoload.inc.php";
    include "./templates/header.php";
    include "./templates/navigation.php";

?>

    <div class="my-8 mx-4 grid grid-cols-3 gap-4">
        <div class="col-span-2">
            <div class="card bordered w-full">
                <div class="card-body">
                    <h2 class="card-title">Buku</h2>
                    <div class="overflow-x-auto" id="table">
                        <table class="table w-full" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Judul</th>
                                    <th>Pengarang</th>
                                    <th>Stok</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    $buku = new Buku();
                                    $listBuku = $buku->index();

                                    foreach ($listBuku as $rowBuku) {
                                ?>

                                <tr class="group">
                                    <th class="group-hover:bg-gray-500 group-hover:bg-opacity-75"><?= $rowBuku['id'] ?></td>
                                    <td class="group-hover:bg-gray-500 group-hover:bg-opacity-75"><?= $rowBuku['judul'] ?></td>
                                    <td class="group-hover:bg-gray-500 group-hover:bg-opacity-75"><?= $rowBuku['pengarang'] ?></td>
                                    <td class="group-hover:bg-gray-500 group-hover:bg-opacity-75"><?= $rowBuku['stok'] ?></td>

                                    <td class="group-hover:bg-gray-500 group-hover:bg-opacity-75">
                                        <a href="editBuku.php?id=<?= $rowBuku['id'] ?>">
                                        <button type="button" bukuid="<?= $rowBuku['id'] ?>"
                                            class="btn btn-sm btn-secondary border-black">Update</button>
                                        </a>
                                        <button type="button" id="hapus" bukuid="<?= $rowBuku['id'] ?>" 
                                            class="btn btn-sm btn-accent border border-black">Hapus</button>
                                    </td>
                                </tr>

                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="card bordered w-full">

                <div class="card-body">
                    <h2 class="card-title">Tambah Buku
                    </h2>
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Judul</span>
                        </label>
                        <input name="judul" id="judul" placeholder="judul"
                            type="text" class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Pengarang</span>
                        </label>
                        <input name="pengarang" id="pengarang" placeholder="pengarang"
                            type="text" class="input input-bordered">
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Stok</span>
                        </label>
                        <input name="stok" id="stok" placeholder="stok"
                            type="number" class="input input-bordered">
                    </div>
                    
                    <div class="justify-end card-actions">
                        <button id="tambah" type="submit" class="btn btn-secondary">Tambah</button>
                        <button type="reset" class="btn btn-accent">Batal</button>
                    </div>
                </div>
            </div>

            <div class="alert mt-4" id="message">
                <div class="flex-1">
                    <label></label>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" 
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        $('#message').hide();

        $('#tambah').click(function(){
            var judul = $('#judul').val();
            var pengarang = $('#pengarang').val();
            var stok = $('#stok').val();

            var formData = new FormData();

            formData.append('judul', judul);
            formData.append('pengarang', pengarang);
            formData.append('stok', stok);

            $.ajax({
                type: "POST",
                url: "./includes/tambahBuku.inc.php",
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    $("#message").text("berhasil");
                    $('#message').addClass('alert-success');
                    $("#message").show();
                },
                error: function (data) {
                    // alert(data.responseText); //===Show Error Message====
                    $("#message").text("gagal");
                    $('#message').addClass('alert-error');
                    $("#message").show();
                }

            });

            $('#table').load(" #table > ");
        })

        $("body").on('click', '#hapus', function () {
            if (!confirm("hapus data?")) {
                return false;
            }else{
                var id = $(this).attr('bukuid');

                $.ajax({
                    method: "POST",
                    url: "./includes/hapusBuku.inc.php",
                    data: {id : id},
                    success: function (data) {
                    $("#message").text("berhasil");
                    $('#message').addClass('alert-success');
                    $("#message").show();
                },
                error: function (data) {
                    // alert(data.responseText); //===Show Error Message====
                    $("#message").text("gagal");
                    $('#message').addClass('alert-error');
                    $("#message").show();
                }
                });

            }

            $('#table').load(" #table > ");

        });

    </script>

<?php

    include "./templates/footer.php";

?>