<?php
include 'config.php';

$query = $config->query("SELECT id, merk, harga_jual, satuan_barang, stok, nama_barang FROM barang");
$products = $query->fetchAll(PDO::FETCH_ASSOC);
$queryToko = $config->query("SELECT * FROM toko")->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($queryToko['nama_toko'], ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .title-section {
            background-color: #3498db;
            color: white;
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 20px;
        }
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
            max-width: 250px;
            margin: 10px;
            flex-grow: 1;
            flex-basis: calc(25% - 20px);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 10px;
            background-color: #ffffff;
            display: grid;
            grid-template-rows: auto 1fr auto;
            gap: 10px;
        }
        .product-card img {
            max-width: 100%;
            height: auto;
            border-bottom: 1px solid #ddd;
            padding-bottom: 15px;
            align-self: center;
        }
        .product-card h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #34495e;
        }
        .product-card p {
            margin: 5px 0;
            color: #555;
        }
        .product-card .price {
            color: #e74c3c;
            font-size: 16px;
            margin: 10px 0;
        }
        .product-card .btn-chat {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }
        .product-card .btn-chat:hover {
            background-color: #2980b9;
        }
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 200px;
          
            height: 200px;
        }
        @media (max-width: 768px) {
            .product-card {
                flex-basis: calc(50% - 20px);
            }
        }
        @media (max-width: 480px) {
            .product-card {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title-section">
            <h1><?php echo htmlspecialchars($queryToko['nama_toko'], ENT_QUOTES, 'UTF-8'); ?></h1>
        </div>
        <div class="product-grid">
            <?php foreach ($products as $product): 
                $message = urlencode("Halo, saya tertarik untuk membeli produk berikut:\n\nNama Barang: " . htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8') . "\nMerk: " . htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8') . "\nHarga: Rp " . htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8') . "\nSatuan: " . htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'));
                ?>
                <div class="product-card">
                    <img src="get_image.php?id=<?php echo htmlspecialchars($product['id'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?>" class="center">
                    <div class="product-info">
                        <h3><?php echo htmlspecialchars($product['nama_barang'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p class="merk"><?php echo htmlspecialchars($product['merk'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="price">Rp <?php echo htmlspecialchars($product['harga_jual'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <p class="satuan"><?php echo htmlspecialchars($product['satuan_barang'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <a href="https://wa.me/6285158242422?text=<?php echo $message; ?>" class="btn-chat">CHAT</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
