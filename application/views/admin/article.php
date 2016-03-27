<link rel="stylesheet" href="<?php echo base_url();?>js/umeditor/themes/default/css/umeditor.css">
<div id="page-wrapper">

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <h1 class="page-header">文章管理</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php
                       echo form_open(" ",
                            array('id'=>'article_form'),
                            array('article_id'=>$id)
                       );
                    ?>
                    <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="title" placeholder="文章标题">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input class="form-control" type="text" name="source" placeholder="信息来源,默认“本站发布”">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <select class="form-control" id="category" name="category">
                                <option value="0">请选择文章类别</option>
                                <?php
                                    foreach($category as $c) {
                                        echo "<option value=\"{$c['id']}\">{$c['category']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <script id="container" name="content" type="text/plain" style="width:98%"></script>
                            <script type="text/javascript" src="<?php echo base_url()."js/umeditor/umeditor.config.js" ?>"></script>
                            <script type="text/javascript" src="<?php echo base_url()."js/umeditor/umeditor.js" ?>"></script>
                            <script type="text/javascript" src="<?php echo base_url()."js/umeditor/lang/zh-cn/zh-cn.js" ?>"></script>
                            <script type="text/javascript">
                                var ume = UM.getEditor('container');
                            </script>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="button" id="btn_save" class="btn btn-success" value="保存">
                            <input type="button" id="btn_publish" class="btn btn-primary" value="直接发布">
                            <input type="button" id="btn_preview" class="btn btn-warning" value="预览">
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="<?php echo base_url();?>js/admin/article.js"></script>
