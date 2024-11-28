<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">	
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNEAKLY</title>
    <link rel="stylesheet" href="public/css/main.css">
    <!-- <link rel="stylesheet" href="public/css/text.css"> -->
    <link rel="stylesheet" href="public/css/chitietsp.css">
    <link rel="stylesheet" href="public/css/header.css">
	<link rel="stylesheet" href="public/css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header class="header">
    <div class="container"> 
        <div class="col-md-4 col-sm-12 col-xs-12 evo-header-mobile">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <div class="logo evo-flexitem evo-flexitem-fill">
                <a href="index.php" class="logo-wrapper" title="Be Classy - Giày Da Nam, Giày Tây Nam Sang Trọng">
                <img src="public/upload/logo.png" alt="SNEAKLY - Giày Sneaker Chính Hãng" class="img-responsive center-block">
                </a>
            </div>
        </div>
        
        <div class="container nav-evo-watch"> 
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <ul id="nav" class="nav">
                        <li class="nav-item has-childs">
                            
                            <a href="/san-pham-noi-bat" class="nav-link" title="DRESS SHOES">SẢN PHẨM</a>			
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="">NAM</a>
                                <a class="dropdown-item" href="">NỮ</a>
                                <a class="dropdown-item" href="">SALE OFF</a>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/he-thong-cua-hang" title="STORES">TIN TỨC</a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php?pg=lienhe" title="STORES">LIÊN HỆ</a></li>
                        <li class="nav-item">
                            <?php if (isset($_SESSION['username'])): ?>
                                <div class="dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" title="USER">
                                        <i class="fas fa-user"></i> 
                                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                                    </a>
                                    <div class="dropdown-menu"> 
                                    <?php if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1): ?>
                                        <a class="dropdown-item" href="admin">Trang Quản Trị</a>
                                        <?php endif; ?>
                                        <a class="dropdown-item" href="index.php?pg=profile">Thông Tin Cá Nhân</a>
                                        <a class="dropdown-item" href="index.php?pg=doimatkhau">Đổi Mật Khẩu</a>
                                        <a class="dropdown-item" href="index.php?pg=dangxuat">Đăng Xuất</a>
                                       
                                    </div>
                                </div>
                            <?php else: ?>
                                <a class="nav-link" href="index.php?pg=dangnhap" title="STORES"> <i class="fas fa-user"></i> TÀI KHOẢN</a>
                                
                                
                            <?php endif; ?>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/he-thong-cua-hang" title="STORES"><i class="fas fa-shopping-cart"></i> GIỎ HÀNG</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
</body>
</html>