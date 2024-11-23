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
                                <th>Username</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Role</th>
                            </thead>
                            <tbody>
                                <?php
                                    $users = $data['users'];
                                    foreach ($users as $user) {
                                        echo '<tr>';
                                        echo '<td>' . $user['id'] . '</td>';
                                        echo '<td>' . $user['username'] . '</td>';
                                        echo '<td>' . $user['email'] . '</td>';
                                        echo '<td>' . $user['password'] . '</td>';
                                        echo '<td>' . $user['role'] . '</td>';
                                        echo '</tr>';
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
