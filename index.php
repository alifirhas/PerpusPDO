<?php
    $title = "Perpus | Home";

    include "./includes/class-autoload.inc.php";
    include "./templates/header.php";
    include "./templates/navigation.php";

    $buku = new Buku();
    $listBuku = $buku->index();

    $anggota = new Anggota();
    $listAnggota = $anggota->index();

?>



    <div class="my-8 mx-4 grid grid-cols-3 gap-4">
        <div class="col-span-2">
            <div class="card bordered w-full">
                <div class="card-body">
                    <h2 class="card-title">Transaksi terbaru</h2>
                    <div class="overflow-x-auto" id="table">
                        <table class="table w-full">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Anggota</th>
                                    <th>Buku</th>
                                    <th>Pinjam</th>
                                    <th>Kembali</th>
                                    <th>Status</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $transaksi = new Transaksi();
                                $listTransaksi = $transaksi->index();

                                foreach ($listTransaksi as $rowTransaksi) {
                                ?>

                                <tr class="hover:active">
                                    <th><?= $rowTransaksi['id'] ?></th>
                                    <td><?= $rowTransaksi['anggota'] ?></td>
                                    <td><?= $rowTransaksi['buku'] ?></td>
                                    <td><?= $rowTransaksi['tgl_pinjam'] ?></td>
                                    <td><?= $rowTransaksi['tgl_kembali'] ?></td>
                                    <td><?= $rowTransaksi['status'] ?></td>
                                    <td class="group-hover:bg-gray-500 group-hover:bg-opacity-75">

                                        <button type="button" id="selesai" transaksiid="<?= $rowTransaksi['id'] ?>"
                                            class="btn btn-sm btn-secondary border-black">Selesai</button>
                                        <button type="button" id="hapus" transaksiid="<?= $rowTransaksi['id'] ?>" 
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
                    <h2 class="card-title">Tambah transaksi
                    </h2>
                    
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Anggota</span>
                        </label>
                        <select name="anggota" id="anggota" class="input select-bordered w-full">
                            <option disabled="disabled" selected="selected">pilih anggota</option>
                            <?php
                            
                            foreach ($listAnggota as $rowAnggota) {

                            ?>

                            <option value="<?= $rowAnggota['id'] ?>"><?= $rowAnggota['nama'] ?></option>

                            <?php
                            
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Buku</span>
                        </label>
                        <select name="buku" id="buku" class="select select-bordered w-full">
                            <option disabled="disabled" selected="selected">pilih buku</option>
                            <?php
                            
                            foreach ($listBuku as $rowBuku) {

                            ?>

                            <option value="<?= $rowBuku['id'] ?>"><?= $rowBuku['judul'] ?></option>

                            <?php
                            
                            }

                            ?>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Tanggal Pinjam</span>
                            </label>
                            <input name="tglPinjam" id="tglPinjam" 
                                type="date" class="input input-bordered">
                        </div>
                        <div class="form-control">
                            <label class="label">
                                <span class="label-text">Tanggal Kembali</span>
                            </label>
                            <input name="tglKembali" id="tglKembali" type="date" class="input input-bordered">
                        </div>
                    </div>
                    
                    <div class="justify-end card-actions">
                        <button id="tambah" class="btn btn-secondary">Tambah</button>
                        <button class="btn btn-accent">Batal</button>
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
            var anggota = $('#anggota').val();
            var buku = $('#buku').val();
            var tglPinjam = $('#tglPinjam').val();
            var tglKembali = $('#tglKembali').val();

            var formData = new FormData();

            formData.append('anggota', anggota);
            formData.append('buku', buku);
            formData.append('tglPinjam', tglPinjam);
            formData.append('tglKembali', tglKembali);

            $.ajax({
                type: "POST",
                url: "includes/tambahTransaksi.inc.php",
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
        });

        $("body").on('click', '#hapus', function () {
            if (!confirm("hapus data?")) {
                return false;
            }else{
                var id = $(this).attr('transaksiid');

                $.ajax({
                    method: "POST",
                    url: "./includes/hapusTransaksi.inc.php",
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

        $("body").on('click', '#selesai', function () {
            if (!confirm("Ubah status?")) {
                return false;
            }else{
                var id = $(this).attr('transaksiid');

                $.ajax({
                    method: "POST",
                    url: "./includes/updateTransaksi.inc.php",
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