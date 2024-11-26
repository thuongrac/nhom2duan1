<?php
include_once "model/database.php"; 
require_once "controller/ProductController.php";

$productController = new ProductController();
$bestSellingProducts = $productController->getBestSellingProducts();
$newProducts = $productController->getNewProducts();

?>



<div class="slider-container">
    <div class="text-container">
        <h5 style="color: white;">Chào Mừng Đến Với SNEAKLY</h5>
        <h4 style="color: white;">Ưu Đãi Siêu Giá Trị</h4>
        <h2 style="color: white;">Trên Tất Cả Sản Phẩm</h2>
        <p style="color: gray;">Tiết kiệm nhiều hơn với phiếu giảm giá và giảm giá tới 70%!</p>
        <a href="index.php?pg=shop"><button>Mua Ngay</button></a>
    </div>
    <div class="image-slider" id="imageSlider">
        <!-- Your image slides go here -->
        <img src="public/upload/b1.png" alt="Image 1">
        <img src="public/upload/b2.png" alt="Image 2">
        <img src="public/upload/b3.png" alt="Image 3">
        <img src="public/upload/b4.png" alt="Image 4">
        <!-- Add more images as needed -->
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const imageSlider = document.getElementById("imageSlider");
        const images = document.querySelectorAll(".image-slider img");

        let currentIndex = 0;
        images[currentIndex].style.display = "block";

        function nextImage() {
            images[currentIndex].style.display = "none";
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].style.display = "block";
        }

        setInterval(nextImage, 3000);
    });
</script>

<section id="feature" class="section-p1">
    <div class="fe-box">
        <img src="public/upload/f1.png" alt="">
        <h6>Miễn Phí Giao Hàng</h6>
    </div>
    <div class="fe-box">
        <img src="public/upload/f2.png" alt="">
        <h6>Đặt Hàng Online</h6>
    </div>
    <div class="fe-box">
        <img src="public/upload/f3.png" alt="">
        <h6>Tiết Kiệm Tiền</h6>
    </div>
    <div class="fe-box">
        <img src="public/upload/f4.png" alt="">
        <h6>Hỗ Trợ 24h</h6>
    </div>
</section>

<section id="product1" class="section-p1">
    <center><h2>SẢN PHẨM BÁN CHẠY</h2></center>
    <div class="pro-container">
        <ul class="products">
            <?php if (!empty($bestSellingProducts)) : ?>
                <?php foreach ($bestSellingProducts as $product) : ?>
                    <li>
                        <div class="product-item">
                            <div class="product-top">
                            <a href="index.php?pg=chitietsp&id=<?= htmlspecialchars($product['id_sanpham']) ?>" class="product-thumb">
                                <img src="public/upload/<?= htmlspecialchars($product['hinh'] ?? 'default.png') ?>" alt="">
                            </a>
                                <a href="#" class="buy-now">Mua ngay</a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-cat"><?= htmlspecialchars($product['tendanhmuc'] ?? 'Không rõ danh mục') ?></a>
                                <a href="#" class="product-cat"><?= htmlspecialchars($product['tensanpham'] ?? 'Không tên') ?></a>
                                <div class="product-price"><?= number_format($product['gia'], 0, ',', '.') ?> VND</div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Không có sản phẩm nào.</p>
            <?php endif; ?>
        </ul>
    </div>
</section>

<section id="product2" class="section-p1">
    <center><h2>SẢN PHẨM MỚI</h2></center>
    <div class="pro-container">
        <ul class="products">
            <?php if (!empty($newProducts)) : ?>
                <?php foreach ($newProducts as $product) : ?>
                    <li>
                        <div class="product-item">
                            <div class="product-top">
                                <a href="index.php?pg=chitietsp&id=<?= htmlspecialchars($product['id_sanpham']) ?>" class="product-thumb">
                                    <img src="public/upload/<?= htmlspecialchars($product['hinh'] ?? 'default.png') ?>" alt="">
                                </a>
                                <a href="#" class="buy-now">Mua ngay</a>
                            </div>
                            <div class="product-info">
                                <a href="#" class="product-cat"><?= htmlspecialchars($product['tendanhmuc'] ?? 'Không rõ danh mục') ?></a>
                                <a href="#" class="product-cat"><?= htmlspecialchars($product['tensanpham'] ?? 'Không tên') ?></a>
                                <div class="product-price"><?= number_format($product['gia'], 0, ',', '.') ?> VND</div>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Không có sản phẩm nào.</p>
            <?php endif; ?>
        </ul>
    </div>
</section>


