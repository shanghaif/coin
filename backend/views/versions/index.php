<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '版本列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>版本列表</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary btn-xs" href="<?= Url::to(['edit'])?>">
                            <i class="fa fa-plus"></i>  添加新版本
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>设备类型</th>
                            <th>版本号</th>
                            <th>下载地址</th>
                            <th>描述</th>
                            <th>是否启用</th>
                            <th>添加时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($data as $model){ ?>
                            <tr>
                                <td><?= $model->id?></td>
                                <td><?= $type[$model->type]?></td>
                                <td><?= $model->ver_num?></td>
                                <td><?= $model->package_url?></td>
                                <td><?= $model->description?></td>
                                <td><span style="color:<?= $status_color[$model->status]?>;"><?= $status[$model->status]?></span></td>
                                <td><?= date('Y-m-d H:i:s', $model->add_time)?></td>
                                <td>
                                    <?php if($model->status == 0){?>
                                        <a href="#" data-id="<?=$model->id?>" class="enable"><span class="btn btn-info btn-sm">启用</span></a>&nbsp;
                                    <?php }else{?>
                                        <a href="#" data-id="<?=$model->id?>" class="disable"><span class="btn btn-danger btn-sm">禁用</span></a>&nbsp;
                                    <?php }?>
                                    <a href="<?= Url::to(['edit','id'=>$model->id])?>""><span class="btn btn-info btn-sm">修改</span></a>&nbsp;
                                    <a href="<?= Url::to(['delete','id'=>$model->id])?>"  onclick="rfDelete(this);return false;"><span class="btn btn-warning btn-sm">删除</span></a>&nbsp;
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".enable").click(function() {
        var id = $(this).attr("data-id");
        swal({
            title: "确定吗？",
            text: "真的要启用吗！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "启用！",
            closeOnConfirm: false
        },function () {
            $.ajax({
                url: "enable",
                type: "POST",
                data: {id: id, status: 1},
                success: function (result) {
                    result = $.parseJSON(result)
                    if (result.code == 200) {
                        rfSuccess('启用', result.message);
                    } else {
                        rfError('启用', result.message);
                    }
                }
            });
        });
    });
    $(".disable").click(function(){
        var id = $(this).attr("data-id");
        swal({
            title: "确定吗？",
            text: "真的要禁用吗！",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "禁用！",
            closeOnConfirm: false
        },function () {
            $.ajax({
                url:"enable",
                type:"POST",
                data:{id:id,status:0},
                success : function(result) {
                    result = $.parseJSON(result)
                    if(result.code == 200){
                        rfSuccess('禁用', result.message);
                    }else{
                        rfError('禁用', result.message);
                    }
                }
            });
        });
    });
</script>
