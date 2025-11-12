<?php
function cari($keyword)
{
    $link = mysqli_connect("127.0.0.1", "root", "", "perpustakaan", "3307");

    // Inisialisasi array kosong supaya tidak undefined
    $listbuku = [];

    $query = "SELECT id, judul FROM buku WHERE judul LIKE '%$keyword%'";
    $result = mysqli_query($link, $query);

    // Pastikan query berhasil
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            $listbuku[] = $row;
        }
    }

    mysqli_close($link);
    return $listbuku;
}

function display($listbuku)
{
    if (empty($listbuku)) {
        echo "<p>Tidak ada hasil yang ditemukan.</p>";
        return;
    }

    echo "<br><table border=1 style='width:50%'>";
    echo "<tr><th style='width:10%'>ID</th><th style='width:60%'>Judul</th><th></th></tr>";

    foreach ($listbuku as $row) {
        echo "<tr>
                <td style='text-align:center;'>$row[0]</td>
                <td>$row[1]</td>
                <td style='text-align:center;'>
                    <a href='./pinjam/pinjam.php?fitur=add&idbuku=$row[0]&judul=$row[1]'>Pinjam</a>
                </td>
              </tr>";
    }
    echo "</table>";
}
?>

<form method="get">
    <input type="text" name="keyword"/>
    <input type="submit" value="CARI"/>
</form>
<a href="./pinjam/pinjam.php?fitur=read">Lihat keranjang</a>
<br>

<?php
// Jalankan fungsi hanya jika keyword dikirim
if (isset($_GET['keyword'])) {
    $hasil = cari($_GET['keyword']);
    display($hasil);
}
?>
