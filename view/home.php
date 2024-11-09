
 <?php
 
 
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
      <img src="layout/img/b1.jpg" alt="Image 1">
      <img src="layout/img/b2.jpg" alt="Image 2">
      <img src="layout/img/b3.jpg" alt="Image 3">
      <img src="layout/img/b4.jpg" alt="Image 4">
      <!-- Add more images as needed -->
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
  const imageSlider = document.getElementById("imageSlider");
  const images = document.querySelectorAll(".image-slider img");

  let currentIndex = 0;

  // Show the first image initially
  images[currentIndex].style.display = "block";

  // Function to switch to the next image
  function nextImage() {
    images[currentIndex].style.display = "none";
    currentIndex = (currentIndex + 1) % images.length;
    images[currentIndex].style.display = "block";
  }

  // Set an interval to switch images every 3 seconds (adjust as needed)
  setInterval(nextImage, 3000);
});

  </script>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="layout/img/f1.png" alt="">
            <h6>Miễn Phí Giao Hàng</h6>
        </div>
        <div class="fe-box">
            <img src="layout/img/f2.png" alt="">
            <h6>Đặt Hàng Online</h6>
        </div>
        <div class="fe-box">
            <img src="layout/img/f3.png" alt="">
            <h6>Tiết Kiệm Tiền</h6>
        </div>
        <div class="fe-box">
            <img src="layout/img/f4.png" alt="">
            <h6>Hỗ Trợ 24h</h6>
        </div>
    </section>


<section id="product1" class="section-p1">
    <h2>SẢN PHẨM BÁN CHẠY</h2>
    <div class="pro-container">
        <!-- Hiển thị sản phẩm bán chạy -->
        <?= $html_luotmua; ?>
    </div>
</section>

    <section id="product1" class="section-p1">

        <h2>SẢN PHẨM MỚI</h2>
        <!-- <p>Summer Collection New Morden Design</p> -->
        <div class="pro-container">
            <!--sản phẩm mới -->
            <?=$html_dssp_new;?>
        </div>
    </section>

    

   

    

