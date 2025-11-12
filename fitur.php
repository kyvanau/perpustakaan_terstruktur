<html>
    <body>
<?php
include "cari.php";
$fitur = $_GET['fitur'] ?? null;
switch ($fitur) {
    case 'pinjam':
        header('location:pinjam/pinjam.php?fitur=read');
        exit;
    case 'cari':
    default:
       $keyword = $_GET['keyword'] ?? '';
        $listbuku = cari( $keyword );
        display( $listbuku ); 
        break; 
}

?>
    </body>
</html>