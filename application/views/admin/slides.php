<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1 class="page-header">幻灯管理</h1>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class=""></div>
                    <button id="newItem" class="btn btn-primary">新增图片</button>
                    <div class="table-response">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <td>缩略图</td>
                                    <td>说明文字</td>
                                    <td>状态</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                       <img src="/images/slides/a.png" class="img-polaroid" style="width: 140px;">
                                    </td>
                                    <td>文本文本文本文本文本文本文本文本文本文本文本文本文本文本</td>
                                    <td>显示</td>
                                    <td>删除 修改</td>
                                </tr>
                                <tr>
                                    <td>
                                       <img src="/images/slides/b.png" class="img-polaroid" style="width: 140px;">
                                    </td>
                                    <td>文本文本文本文本文本文本文本文本文本文本文本文本文本文本</td>
                                    <td>显示</td>
                                    <td>删除 修改</td>
                                </tr>
                                <tr>
                                    <td>
                                       <img src="/images/slides/a.png" class="img-polaroid" style="width: 140px;">
                                    </td>
                                    <td>文本文本文本文本文本文本文本文本文本文本文本文本文本文本</td>
                                    <td>显示</td>
                                    <td>删除 修改</td>
                                </tr>
                        </tbody>
                    </table>
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
                <h4 class="modal-title" id="myModalLabel">滚动图片</h4>
            </div>

            <?php
/*
                echo form_open("dashboard/slide_add",
                    array('id'=>'slide_form'),
                    array('navi_id'=>0)
                );
 */
                echo form_open_multipart('dashboard/slide_upload',
                    array('id'=>'slide_form')
                );
            ?>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="slide">上传图片</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="file" id="slide" name="userfile" placeholder="请输入名称...">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="status">状态</label>
                                </div>
                                <div class="col-md-9">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" checked> 显示
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="category"> 不显示
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" id="div_fixedurl">
                                <div class="col-md-3">
                                    <label for="description">描述</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea class="form-control" id="description" name="description" placeholder="图片描述"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group" id="div_fixedurl">
                                <div class="col-md-3">
                                    <label for="url">点击链接</label>
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" id="url" name="url" placeholder="请输如链接 如 http://www.baidu.com">
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
            <?php echo form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script src="<?php echo base_url();?>js/admin/slides.js"></script>
