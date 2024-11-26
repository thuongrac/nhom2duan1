<?php
include_once "model/database.php";
require_once "controller/ProductController.php";

$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    $productController = new ProductController();
    $product = $productController->getProductById($productId);
} else {
    echo "Sản phẩm không tồn tại.";
    exit;
}
?>

<body>
  <div class="product-details">
    <div class="container">
      <div class="product-header">
      <div class="product-images">
        <img src="public/upload/<?= htmlspecialchars($product['hinh'] ?? 'default.png') ?>" alt="Main Product" class="main-image">
      </div>
        <div class="product-info">
        <h1><?= htmlspecialchars($product['tensanpham']) ?></h1>
        <p class="price"><?= number_format($product['gia'], 0, ',', '.') ?> VND</p>
          <div class="actions">
            <input type="number" value="1" min="1" class="quantity">
            <button class="add-to-cart">Thêm vào giỏ hàng</button>
          </div>
          <ul class="details">
            <li><strong>Tình trạng:</strong>Còn hàng</li>
            <li><strong>Vận chuyển:</strong>Vận chuyển 1 ngày,<span class="highlight"> Nhận hàng miễn phí hôm nay</span></li>
            <li><strong>Trọng lượng:</strong> 0.5 kg</li>
          </ul>
          <div class="share">
            <span>Share on:</span>
            <a href="#">Facebook</a>
            <a href="#">Twitter</a>
            <a href="#">Instagram</a>
          </div>
        </div>
      </div>
      <div class="product-tabs">
        <ul class="tabs">
          <li class="active">Miêu tả</li>
          <li>Thông tin</li>
          <li>Đánh giá (1)</li>
        </ul>
        <div class="tab-content">
          <p>  Giày thời trang là một phần không thể thiếu trong phong cách cá nhân, mang lại sự tự tin và thể hiện gu thẩm mỹ của người sử dụng. Với đa dạng kiểu dáng, màu sắc và chất liệu, giày thời trang không chỉ đáp ứng nhu cầu tiện ích mà còn là tuyên ngôn thời trang.
          </p>
        </div>
      </div>
      <div class="related-products">
        <h2>Sản phẩm liên quan</h2>
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
      </div>
    </div>
  </div>
</body>