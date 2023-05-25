<?php
session_start();

//koneksi ke database
include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
  echo "<script>alert('Keranjang kosong, silahkan pilih produk!');</script>";
  echo "<script>location='index.php';</script>";
}

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";
?>

<!DOCTYPE html>
<title>keranjang </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<img src="img/header.jpg" width=100% height=30%>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<body>

<?php include 'templates/navbar.php'; ?>

<section class="content">
  <div class="container">
  <h1>keranjang Belanja</h1>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>No</th>
          <th>Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subharga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; ?>
        <?php foreach($_SESSION['keranjang'] as $id_produk => $jumlah): ?>
        <!-- Menampilkan produk yang sedang duperulangkan berdasarkan id_produk -->
        <?php
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $pecah = $ambil->fetch_assoc();
        
        $subharga = $pecah['harga_produk'] * $jumlah;
        // echo "<pre>";
        // print_r($pecah);
        // echo "</pre>";
        ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $pecah['nama_produk']; ?></td>
          <td>Rp. <?= number_format($pecah['harga_produk']); ?>,-</td>
          <td><?= $jumlah; ?></td>
          <td>Rp. <?= number_format($subharga); ?>,-</td>
          <td>
            <a href="hapuskeranjang.php?id=<?= $id_produk; ?>" class="btn btn-danger btn-xs">hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <a href="index.php" class="btn btn-default">Lanjutkan Belanja</a>
    <a href="checkout.php" class="btn btn-primary">Checkout</a>

  </div>
</section>
  
</body>
</html>