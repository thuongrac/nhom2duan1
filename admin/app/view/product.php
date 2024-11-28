<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh mục các sản phẩm</h4>
                        <div>
                            
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Miêu tả</th>
                                <th>Hình ảnh</th>
                                <th>Chức năng</th>
                            </thead>
                            <tbody>
                                <?php
                                    $list = $data['product'];
                                    $kq = '';
                                    $stt = 1;
                                    foreach ($list as $item) {
                                        $id = $item['id'];
                                        $title = $item['title'];
                                        $price = $item['price'];
                                        $image = $item['image'];
                                        $description = $item['description'];

                                        $kq .= '<tr>
                                            <td>'.$stt.'</td>
                                            <td>'.$title.'</td>
                                            <td>'.$price.'</td>
                                            <td>'.$description.'</td>
                                            <td><img src="../public/upload/img/'.$image.'" alt="" height="80px" width="100px"></td>
                                            <td><a href="index.php?page=editpro&id='.$id.'">Sửa</a> | <a href="index.php?page=delpro&id='.$id.'">Xóa</a></td>
                                        </tr>';
                                        $stt++;
                                    }
                                    echo $kq;
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <ul class="pagination-list">
                        <li class="pagination-item">
                            <a href="" class="pagination-link">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">1</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">2</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">3</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">...</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">10</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
