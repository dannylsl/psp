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

                    <div class="col-lg-12 col-md-12">
                    <a href="<?php echo base_url()?>index.php/dashboard/article_add" class="btn btn-primary">新增文章</a>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <td>序号</td>
                                <td>文章标题</td>
                                <td>类别</td>
                                <td>操作</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>关于XXXXXXX的活动通知</td>
                                <td>政策公告</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" id="btn_edit">编辑</button>
                                    <button class="btn btn-sm btn-danger" id="btn_del">删除</button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>关于XXXXXXX的活动通知</td>
                                <td>电子服务</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" id="btn_edit">编辑</button>
                                    <button class="btn btn-sm btn-danger" id="btn_del">删除</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
