<style>
    /* Định kiểu cho nút trạng thái (Cấm, Hoạt động) */
button.status {
    font-weight: bold;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

button.status[data-ban="1"] {
    background-color: #dc3545; /* Màu đỏ cho 'Cấm' */
}

button.status[data-ban="0"] {
    background-color: #28a745; /* Màu xanh lá cho 'Hoạt động' */
}

/* Định kiểu cho nút quyền (Admin, Người dùng) */
button.role {
    font-weight: bold;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}

button.role[data-admin="1"] {
    background-color: #007bff; /* Màu xanh dương cho 'Admin' */
}

button.role[data-admin="0"] {
    background-color: #6c757d; /* Màu xám cho 'Người dùng' */
}

/* Thêm hiệu ứng hover */
button.status:hover,
button.role:hover {
    opacity: 0.8;
}

    </style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    let userId;
    let newStatus;
    let newRole;

    // Khi người dùng nhấp vào ô trạng thái
    $('.status').on('click', function() {
        userId = $(this).data('id');
        newStatus = $(this).data('ban') === 1 ? 0 : 1;
        const admin = $(this).closest('tr').find('td:last-child').text().trim() === 'Admin' ? 1 : 0;

        // Lưu giá trị admin vào button xác nhận
        $('#confirmChange').data('admin', admin);
        // Hiển thị modal xác nhận
        $('#statusModal').modal('show');
    });

    // Khi người dùng nhấp vào ô quyền (Admin/Người dùng)
    $('.role').on('click', function() {
        userId = $(this).data('id');
        newRole = $(this).data('admin') === 1 ? 0 : 1; // Thay đổi quyền từ Admin sang Người dùng và ngược lại
        const user = $(this).closest('tr').find('td:last-child').text().trim() === 'Ban' ? 1 : 0;

        // Lưu giá trị ban vào button xác nhận
        $('#confirmRoleChange').data('role', newRole);
        // Hiển thị modal xác nhận thay đổi quyền
        $('#roleModal').modal('show');
    });

    // Khi người dùng xác nhận thay đổi trạng thái
    $(document).on('click', '#confirmChange', function () {
        const admin = $(this).data('admin');
        console.log('Nút Xác Nhận trạng thái được bấm', { userId, newStatus, admin });

        // Gửi yêu cầu AJAX để thay đổi trạng thái
        $.ajax({
            url: '../admin/app/controller/update_user.php',
            type: 'POST', 
            data: { id: userId, ban: newStatus, admin: admin },
            success: function(response) {
                console.log('Response từ server:', response);
                try { 
                    var jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

                    if (jsonResponse.success) {
                        alert('Cập nhật thành công!');
                        location.reload(); // Tải lại trang sau khi cập nhật thành công
                    } else {
                        alert('Cập nhật thất bại: ' + jsonResponse.message);
                    }
                } catch (error) {
                    alert('Lỗi phân tích JSON: ' + error);
                    console.log('Phản hồi không phải là JSON hợp lệ:', response);
                }
            },
            error: function(xhr, status, error) {
                alert('Có lỗi xảy ra trong quá trình gửi yêu cầu: ' + error);
                console.log('Lỗi AJAX:', error);
            }
        });

        // Ẩn modal chỉ khi yêu cầu AJAX thành công
        $('#statusModal').modal('hide');
    });

    // Khi người dùng xác nhận thay đổi quyền
    $(document).on('click', '#confirmRoleChange', function () {
        console.log('Nút Xác Nhận quyền được bấm', { userId, newRole });

        // Gửi yêu cầu AJAX để thay đổi quyền
        $.ajax({
            url: '../admin/app/controller/update_user.php',
            type: 'POST', 
            data: { id: userId, ban: null, admin: newRole }, // Không thay đổi ban (Cấm/Hoạt động)
            success: function(response) {
                console.log('Response từ server:', response);
                try { 
                    var jsonResponse = typeof response === 'string' ? JSON.parse(response) : response;

                    if (jsonResponse.success) {
                        alert('Cập nhật quyền thành công!');
                        location.reload(); // Tải lại trang sau khi cập nhật thành công
                    } else {
                        alert('Cập nhật quyền thất bại: ' + jsonResponse.message);
                    }
                } catch (error) {
                    alert('Lỗi phân tích JSON: ' + error);
                    console.log('Phản hồi không phải là JSON hợp lệ:', response);
                }
            },
            error: function(xhr, status, error) {
                alert('Có lỗi xảy ra trong quá trình gửi yêu cầu: ' + error);
                console.log('Lỗi AJAX:', error);
            }
        });

        // Ẩn modal
       $('#roleModal').modal('hide');
    });

    // Khi người dùng đóng modal mà không thay đổi
    $(document).on('click', '.btn-secondary, .close', function() {
        console.log('Modal đã được đóng');
        $('#statusModal').modal('hide');
        $('#roleModal').modal('hide');
    });
});

</script>


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách người dùng</h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Tên Đăng Nhập</th>
                                <th>Số Điện Thoại</th>
                                <th>Trang thái</th>
                                <th>Quyền</th>
                            </thead>
                            <tbody>
                            <tbody>
<?php
    if (isset($data['user']) && !empty($data['user'])) {
        foreach ($data['user'] as $user) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($user['id_user']) . '</td>';
            echo '<td>' . htmlspecialchars($user['taikhoan']) . '</td>';
            echo '<td>' . htmlspecialchars($user['sdt']) . '</td>';

            // Trạng thái có thể chỉnh sửa
            echo '<td>';
            echo '<button class="btn btn-' . ($user['ban'] == 1 ? 'danger' : 'success') . ' status" data-id="' . htmlspecialchars($user['id_user']) . '" data-ban="' . $user['ban'] . '">';
            echo ($user['ban'] == 1 ? 'Cấm' : 'Hoạt động');
            echo '</button>';
            echo '</td>';

            // Quyền có thể chỉnh sửa
            echo '<td>';
            echo '<button class="btn btn-' . ($user['admin'] == 1 ? 'primary' : 'danger') . ' role" data-id="' . htmlspecialchars($user['id_user']) . '" data-admin="' . $user['admin'] . '">';
            echo ($user['admin'] == 1 ? 'Admin' : 'Người dùng');
            echo '</button>';
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6">Không có người dùng nào.</td></tr>';
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
        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusModalLabel">Xác Nhận Thay Đổi Trạng Thái</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn thay đổi trạng thái này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirmChange">Xác Nhận</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal thay đổi quyền -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Xác Nhận Thay Đổi Quyền</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Bạn có chắc chắn muốn thay đổi quyền của người dùng này không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirmRoleChange">Xác Nhận</button>
            </div>
        </div>
    </div>
</div>
