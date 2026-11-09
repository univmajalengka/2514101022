<?php
// =====================================================
// Program Menghitung Diskon Belanja (PHP Native)
// Prosedur/fungsi: hitungDiskon($totalBelanja)
// =====================================================

// Prosedur untuk menghitung diskon berdasarkan total belanja
function hitungDiskon($totalBelanja) {
    $diskon = 0; // Default: tidak ada diskon

    if ($totalBelanja >= 100000) {
        // Diskon 10% untuk total belanja >= Rp. 100.000
        $diskon = 0.1 * $totalBelanja;
    } elseif ($totalBelanja >= 50000) {
        // Diskon 5% untuk total belanja >= Rp. 50.000 dan < Rp. 100.000
        $diskon = 0.05 * $totalBelanja;
    }
    // Total belanja < Rp. 50.000 : tidak ada diskon

    return $diskon; // Mengembalikan nilai diskon
}

// Fungsi bantu untuk format Rupiah
function rupiah($angka) {
    return "Rp. " . number_format($angka, 0, ',', '.');
}

// Nilai awal (contoh total belanja Rp. 120.000)
$totalBelanja = 120000;

// Jika form dikirim, gunakan nilai dari input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalBelanja = isset($_POST['total_belanja']) ? (float) $_POST['total_belanja'] : 0;
    if ($totalBelanja < 0) {
        $totalBelanja = 0;
    }
}

// Memanggil prosedur untuk menghitung diskon
$diskon = hitungDiskon($totalBelanja);
$totalBayar = $totalBelanja - $diskon;

// Persentase diskon untuk keterangan
if ($totalBelanja >= 100000) {
    $persen = "10%";
} elseif ($totalBelanja >= 50000) {
    $persen = "5%";
} else {
    $persen = "0% (tidak ada diskon)";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hitung Diskon Belanja</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f4f7; margin: 0; padding: 30px; }
        .box { max-width: 460px; margin: auto; background: #fff; padding: 24px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,.1); }
        h2 { margin-top: 0; }
        input[type=number] { width: 100%; padding: 8px; margin: 6px 0 12px; box-sizing: border-box; }
        button { padding: 9px 18px; background: #2563eb; color: #fff; border: 0; border-radius: 6px; cursor: pointer; }
        table { width: 100%; margin-top: 18px; border-collapse: collapse; }
        td { padding: 8px; border-bottom: 1px solid #ddd; }
        td:last-child { text-align: right; }
        .total td { font-weight: bold; }
    </style>
</head>
<body>
<div class="box">
    <h2>Hitung Diskon Belanja</h2>

    <form method="post" action="">
        <label for="total_belanja">Total Belanja (Rp)</label>
        <input type="number" id="total_belanja" name="total_belanja" min="0"
               value="<?= htmlspecialchars((string) $totalBelanja) ?>" required>
        <button type="submit">Hitung</button>
    </form>

    <table>
        <tr><td>Total belanja</td><td><?= rupiah($totalBelanja) ?></td></tr>
        <tr><td>Diskon (<?= $persen ?>)</td><td><?= rupiah($diskon) ?></td></tr>
        <tr class="total"><td>Total yang harus dibayar</td><td><?= rupiah($totalBayar) ?></td></tr>
    </table>
</div>
</body>
</html>