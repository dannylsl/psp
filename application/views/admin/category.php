<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1 class="page-header">文章类别管理</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <table id="category_tbl" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>类别</td>
                                <td>操作</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                for($i = 0; $i < $rows_count; $i++) {
                            ?>
                            <tr>
                                <td><?php echo $category[$i]['category'];?></td>
                                <td id="<?php echo $category[$i]['id']; ?>">
                                    <button class="btn btn-sm btn-warning" id="btn_edit">编辑</button>
                                    <button class="btn btn-sm btn-danger" id="btn_del">删除</button>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>

                    <div class="row">
                        <?php
                            echo form_open("dashboard/category_add",
                                array('id'=>'category_form'),
                                array('rows_count'=>$rows_count)
                            );
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <input class="form-control" type="text" id="category" name="category" placeholder="请输入类别名称..." />
                        </div>
                        <div class="col-md-3">
                            <input type="button" id="btn_new_category" class="btn btn-primary" value="新增类别">
                        </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade in" id="itemDialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false" style="display: none;">
    <div class="modal-backdrop fade in"></div>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">文章类别</h4>
            </div>

            <?php
                echo form_open("/",
                    array('id'=>'category_update_form'),
                    array('category_id'=>'')
                );
            ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="itemName">名称</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="category_name" placeholder="请输入名称...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="button" class="btn btn-primary" id="btn_update_category" value="保存">
                </div>

            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script src="<?php echo base_url();?>js/admin/category.js"></script>
