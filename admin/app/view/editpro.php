<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Cập nhật sản phẩm</h4>
                        <p class="category"></p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <form action="index.php?page=updatepro&id=<?= isset($pro_detail['id']) ? $pro_detail['id'] : '' ?>" method="post" enctype="multipart/form-data">
                            
                            <label for="cate">Danh mục sản phẩm</label>
                            <select name="category_id" id="category_id" class="form-control">
                            <?php
                            var_dump($data);
                                if (isset($data['listcate'])) {
                                    foreach ($data['listcate'] as $item) {
                                        echo '<option value="'.$item['id'].'">'.$item['name'].'</option>';
                                    }
                                }
                                ?>
                            </select>
                            <?php
                                if(empty($data)){
                                     echo '<h2>Không tìm thấy sản phẩm</h2>';
                                }
                                else{
                                    $row = $data['pro_detail'];
                                }
                            ?> 
                            
                            <input type="hidden" name="id" value="<?= isset($row['id']) ? $row['id'] : '' ?>"> 

                            <label for="title">Tên sản phẩm</label>
                            <input type="text" name="title" id="title" class="form-control" value="<?= isset($row['title']) ? $row['title'] : '' ?>">
                            <label for="price">Giá sản phẩm</label>
                            <input type="number" name="price" id="price" class="form-control" value="<?= isset($row['price']) ? $row['price'] : '' ?>">
                            <label for="description">Miêu tả sản phẩm</label>
                            <textarea name="description" id="description" class="form-control"><?= isset($row['description']) ? $row['description'] : '' ?></textarea>
                            <label for="image">Hình ảnh</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <?php if(isset($row['image']) && !empty($row['image'])): ?>
                                <img src="../public/upload/img/<?= $row['image'] ?>" alt="" height="80px" width="100px">
                                <input type="hidden" name="image" value="<?= $row['image'] ?>">
                            <?php endif; ?>
                            <input type="submit" name="update" value="Cập nhật sản phẩm" class="btn btn-primary">
                    </form>

                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>