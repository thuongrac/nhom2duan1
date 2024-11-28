<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Thêm sản phẩm</h4>
                        <p class="category"></p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <form action="index.php?page=add" method="post" enctype="multipart/form-data">
                            <label for="cate">Danh mục sản phẩm</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">Chọn danh mục</option>
                                <?php
                                if (isset($data['listcate'])) {
                                    foreach ($data['listcate'] as $item) {
                                        echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <label for="title">Tên sản phẩm</label>
                            <input type="text" name="title" id="title" class="form-control">
                            <label for="price">Giá sản phẩm</label>
                            <input type="number" name="price" id="price" class="form-control">
                            <label for="description">Miêu tả sản phẩm</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <input type="submit" name="sub" value="Thêm sản phẩm" class="btn btn-primary">
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
