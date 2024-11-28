<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách đơn hàng</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>STT</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Phương thức thanh toán</th>
                                <th>Trạng thái</th>
                            </thead>
                            <tbody>
                            <?php if (!empty($orders)): ?>
                    <tbody>
                        <?php
                        $stt = 1;
                        foreach ($orders as $item) {
                            echo '<tr>
                                <td>'.$stt.'</td>
                                <td>'.$item['name'].'</td>
                                <td>'.$item['phone'].'</td>
                                <td>'.$item['address'].'</td>
                                <td>'.$item['payment_method'].'</td>
                                <td>'.$item['status'].'</td>
                            </tr>';
                            $stt++;
                        }
                        ?>
                    </tbody>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Không có đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
