<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "erika";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$npsn        = "";
$nama_sekolah       = "";
$alamat     = "";
$status   = "";
$bentuk_pendidikan   = "";

$rt   = "";
$rw   = "";
$dusun   = "";
$desa   = "";
$kecamatan   = "";
$kabupaten   = "";
$provinsi   = "";
$kode_pos   = "";
$sukses     = "";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $id         = $_GET['id'];
    $sql1       = "delete from sekolah where id = '$id'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $id         = $_GET['id'];
    $sql1       = "select * from sekolah where id = '$id'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $npsn        = $r1['npsn'];
    $nama_sekolah       = $r1['nama_sekolah'];
    $alamat     = $r1['alamat'];
    $status   = $r1['status'];
    $rw   = $r1['rw'];
      $rt   = $r1['rt'];
    $dusun   = $r1['dusun'];
     $desa   = $r1['desa'];
 $kecamatan   = $r1['kecamatan'];
$kabupaten   = $r1['kabupaten'];
$provinsi   = $r1['provinsi'];
$kode_pos   = $r1['kode_pos'];
$bentuk_pendidikan   = $r1['bentuk_pendidikan'];
    if ($npsn == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $npsn        = $_POST['npsn'];
    $nama_sekolah       = $_POST['nama_sekolah'];
    $alamat     = $_POST['alamat'];
    $status   = $_POST['status'];
    $rw   = $_POST['rw'];
      $dusun   = $_POST['dusun'];
     $desa   = $_POST['desa'];
 $kecamatan   = $_POST['kecamatan'];
$kabupaten   = $_POST['kabupaten'];
$provinsi   = $_POST['provinsi'];
$kode_pos   = $_POST['kode_pos'];
$bentuk_pendidikan   = $_POST['bentuk_pendidikan'];
    if ($npsn && $nama_sekolah && $alamat && $status && $rw && $dusun && $desa && $kecamatan && $kabupaten && $provinsi && $kode_pos && $rt && $bentuk_pendidikan) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update sekolah set npsn = '$npsn',nama_sekolah='$nama_sekolah',alamat = '$alamat',status='$status',rw='$rw',dusun='$dusun',desa='$desa',kecamatan='$kecamatan',kabupaten='$kabupaten',provinsi='$provinsi',kode_pos='$kode_pos',rt='$rt',bentuk_pendidikan='$bentuk_pendidikan' where id = '$id'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insestatus
            $sql1   = "insestatus into sekolah(npsn,nama_sekolah,alamat,status,rw,dusun,desa,kecamatan,kabupaten,provinsi,kode_pos,rt,bentuk_pendidikan) values ('$npsn','$nama_sekolah','$alamat','$status',$rw,$dusun,$desa,$kecamatan,$kabupaten,$provinsi,$kode_pos,$rt,$bentuk_pendidikan)";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpostatus" content="width=device-width, initial-scale=1.0">
    <title>Data sekolah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alestatus alestatus-danger" role="alestatus">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alestatus alestatus-success" role="alestatus">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=index.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="npsn" class="col-sm-2 col-form-label">npsn</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="npsn" name="npsn" value="<?php echo $npsn ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_sekolah" class="col-sm-2 col-form-label">nama_sekolah</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" value="<?php echo $nama_sekolah ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $alamat ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="status" class="col-sm-2 col-form-label">status</label>
                        <div class="col-sm-10">
                                
                              </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="rw" class="col-sm-2 col-form-label">rw</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rw" name="rw" value="<?php echo $rw ?>">
                                 </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="dusun" class="col-sm-2 col-form-label">dusun</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="dusun" name="dusun" value="<?php echo $dusun ?>">
                                 </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="desa" class="col-sm-2 col-form-label">desa</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="desa" name="desa" value="<?php echo $desa ?>">
                                </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="kecamatan" class="col-sm-2 col-form-label">kecamatan</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="kecamatan" name="kecamatan" value="<?php echo $kecamatan ?>">

                                        </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="kabupaten" class="col-sm-2 col-form-label">kabupaten</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kabupaten" name="kabupaten" value="<?php echo $kabupaten ?>">
                                        </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="provinsi" class="col-sm-2 col-form-label">provinsi</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control" id="provinsi" name="provinsi" value="<?php echo $provinsi ?>">
                                     </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="kode_pos" class="col-sm-2 col-form-label">kode_pos</label>
                        <div class="col-sm-10">
                         <input type="text" class="form-control" id="kode_pos" name="kode_pos" value="<?php echo $kode_pos ?>">

                                     </div>
                         </div>  
                         <div class="mb-3 row">
                        <label for="rt" class="col-sm-2 col-form-label">rt</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="rt" name="rt" value="<?php echo $rt ?>">
                           </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="bentuk_pendidikan" class="col-sm-2 col-form-label">bentuk_pendidikan</label>
                        <div class="col-sm-10">
                               
                                    <select class="form-control" name="status" id="status">
                                <option value="">- Pilih status -</option>
                                <option value="negeri" <?php if ($status == "negeri") echo "selected" ?>>negeri</option>
                                <option value="swasta" <?php if ($status == "swasta") echo "selected" ?>>swasta</option>
                            </select>
                             <select class="form-control" name="bentuk_pendidikan" id="bentuk_pendidikan">
                                <option value="">- Pilih bentuk_pendidikan -</option>
                                <option value="negeri" <?php if ($bentuk_pendidikan == "tk") echo "selected" ?>>tk</option>
                                <option value="swasta" <?php if ($bentuk_pendidikan == "sd") echo "selected" ?>>sd</option>
                                  <option value="negeri" <?php if ($bentuk_pendidikan == "sma") echo "selected" ?>>sma</option>
                                    <option value="negeri" <?php if ($bentuk_pendidikan == "smk") echo "selected" ?>>smk</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data -->
        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data sekolah
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">npsn</th>
                            <th scope="col">nama_sekolah</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">status</th>
                            <th scope="col">rw</th>
                             <th scope="col">dusun</th>
                             <th scope="col">desa</th>
                             <th scope="col">kecamatan</th>
                             <th scope="col">kabupaten</th>
                             <th scope="col">provinsi</th>
                               <th scope="col">kode_pos</th>
                               <th scope="col">rt</th>
                                 <th scope="col">bentuk_pendidikan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql2   = "select * from sekolah order by id desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id         = $r2['id'];
                            $npsn        = $r2['npsn'];
                            $nama_sekolah       = $r2['nama_sekolah'];
                            $alamat     = $r2['alamat'];
                            $status   = $r2['status'];
                           $rw   = $r2['rw'];
                             $dusun   = $r2['dusun'];
     $desa   = $r2['desa'];
 $kecamatan   = $r2['kecamatan'];
$kabupaten   = $r2['kabupaten'];
$provinsi   = $r2['provinsi'];
$kode_pos   = $r2['kode_pos'];
$rt   = $r2['rt'];
$bentuk_pendidikan   = $r2['bentuk_pendidikan'];

                        ?>
                            <tr>
                                <th scope="row"><?php echo $urut++ ?></th>
                                <td scope="row"><?php echo $npsn ?></td>
                                <td scope="row"><?php echo $nama_sekolah ?></td>
                                <td scope="row"><?php echo $alamat ?></td>
                                <td scope="row"><?php echo $status ?></td>
                                 <td scope="row"><?php echo $rw ?></td>
                                 <td scope="row"><?php echo $dusun ?></td>
                                 <td scope="row"><?php echo $desa ?></td>
                                 <td scope="row"><?php echo $kecamatan ?></td>
                                 <td scope="row"><?php echo $kabupaten ?></td>
                                 <td scope="row"><?php echo $provinsi ?></td>
                                 <td scope="row"><?php echo $kode_pos ?></td>
                                  <td scope="row"><?php echo $rt ?></td>
                                       <td scope="row"><?php echo $bentuk_pendidikan ?></td>
                                <td scope="row">
                                    <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-warning">Edit</button></a>
                                    <a href="index.php?op=delete&id=<?php echo $id?>" onclick="return confirm('Yakin mau delete data?')"><button type="button" class="btn btn-danger">Delete</button></a>            
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
</body>

</html>
