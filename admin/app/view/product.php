<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách sản phẩm</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Danh mục</th>
                                    <th>Hình</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php
    if (isset($data['san_pham']) && !empty($data['san_pham'])) {
        foreach ($data['san_pham'] as $product) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($product['id_sanpham']) . '</td>';
            echo '<td>' . htmlspecialchars($product['tensanpham']) . '</td>';
            echo '<td>' . htmlspecialchars($product['gia']) . '</td>';
            echo '<td>' . htmlspecialchars($product['tendanhmuc']) . '</td>';
            
            // Kiểm tra và tạo đường dẫn hình ảnh
            $imagePath = (strpos($product['hinh'], 'http') === 0) ? 
                htmlspecialchars($product['hinh']) : 
                '/nhom2duan1/public/upload/' . htmlspecialchars($product['hinh']);
                
            echo '<td><img src="' . $imagePath . '" alt="Hình sản phẩm" style="max-width: 70px; height: auto;"></td>'; // Hiển thị hình ảnh
            echo '<td><button class="btn btn-warning btn-edit" data-id="' . htmlspecialchars($product['id_sanpham']) . '" data-name="' . htmlspecialchars($product['tensanpham']) . '" data-price="' . htmlspecialchars($product['gia']) . '" data-category="' . htmlspecialchars($product['tendanhmuc']) . '" data-image="' . htmlspecialchars($product['hinh']) . '">Edit</button></td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">Không có sản phẩm nào.</td></tr>';
    }
    ?>
</tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="editModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" name="id" id="productId">
                    <div class="form-group">
                        <label for="productName">Tên Sản Phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Giá</label>
                        <input type="number" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="productCategory">Danh mục</label>
                        <input type="text" class="form-control" id="productCategory" name="category" required>
                    </div>
                    <div class="form-group">
                        <label for="productImage">Hình</label>
                        <input type="text" class="form-control" id="productImage" name="image" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" id="saveButton">Lưu</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Handle edit button click
    const editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = this.getAttribute('data-price');
            const category = this.getAttribute('data-category');
            const image = this.getAttribute('data-image');

            document.getElementById('productId').value = id;
            document.getElementById('productName').value = name;
            document.getElementById('productPrice').value = price;
            document.getElementById('productCategory').value = category;
            document.getElementById('productImage').value = image;

            $('#editModal').modal('show');
        });
    });

    // Handle save button click
    document.getElementById('saveButton').addEventListener('click', function () {
        const form = document.getElementById('editForm');
        const formData = new FormData(form);

        fetch('../admin/app/controller/update_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Cập nhật thành công!');
                location.reload(); // Refresh the page to see the changes
            } else {
                alert('Cập nhật thất bại!');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
console.log('ID:', id);
console.log('Name:', name);
console.log('Price:', price);
console.log('Category:', categoryId);
console.log('Image:', image);
</script>

<!-- Add Bootstrap CSS and JS links if not already included -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>