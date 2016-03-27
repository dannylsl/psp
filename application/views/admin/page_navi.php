<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1 class="page-header">导航栏设置</h1>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-response">
                        <table class="table table-striped table-hover" id="navi_tbl">
                            <thead>
                                <tr>
                                    <td>名称</td>
                                    <td>链接地址</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($navibars as $navi) {
                                ?>
                                <tr id="<?php echo $navi['id']?>">
                                    <td><?php echo $navi['name'];?></td>
                                    <td><?php echo $navi['url'];?></td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" id="btn_edit">编辑</button>
                                        <button class="btn btn-sm btn-danger" id="btn_del">删除</button>
                                    </td>
                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                        <button id="newItem" class="btn btn-primary">新增项目</button>
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
                <h4 class="modal-title" id="myModalLabel">导航项目</h4>
            </div>

            <?php
               echo form_open("dashboard/navibar_add",
                    array('id'=>'navibar_form'),
                    array('navi_id'=>0)
               );
            ?>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="navi_name">名称</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="navi_name" name="navi_name" placeholder="请输入名称...">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="type">类型</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="fixedurl" checked> 固定链接
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="type" value="category"> 文章类别
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" id="div_fixedurl">
                                <div class="col-md-3">
                                    <label for="fixedurl">固定链接</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="fixedurl" name="fixedurl" placeholder="请输入名称...">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" id="div_category" style="display:none">
                                <div class="col-md-3">
                                    <label for="category">文章类别</label>
                                </div>
                                <div class="col-md-9">
                                    <select class="form-control" id="category" name="category" disabled>
                                        <option value="0">请选择类别</option>
                                        <?php
                                            foreach($category as $c) {
                                                echo "<option value=\"{$c['id']}\">{$c['category']}</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <input type="button" id="btn_save" class="btn btn-primary" value="保存"/>
                    <input type="button" id="btn_update" class="btn btn-success" value="保存" style="display:none"/>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script src="<?php echo base_url();?>js/admin/page_navi.js"></script>
