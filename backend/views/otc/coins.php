<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'OTC币种';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>OTC币种列表</h5>
                    <div class="ibox-tools">
                        <a class="btn btn-primary btn-xs" href="<?= Url::to(['edit'])?>">
                            <i class="fa fa-plus"></i>  新增币种
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>币种</th>
                            <th>图标</th>
                            <th>最低发布数量</th>
                            <th>最大挂单数</th>
                            <th>最大挂单时间(小时)</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($models as $model){ ?>
                            <tr>
                                <td><?= $model['coin_id']?></td>                            	
                                <td><?= $model['coin_name']?></td>
                                <td><img src="<?= $model['icon']?>" style="width: 45px;height: 45px"></td>
                                <td><?= $model['limit_amount']?></td>
                                <td><?= $model['max_register_num']?></td>
                                <td><?= $model['max_register_time']?>小时</td>
                                <td>
                                    <?php if($model['status'] == 0){?>
                                        <a href="#" data-id="<?=$model['id']?>" class="enable"><span class="btn btn-info btn-sm">启用</span></a>&nbsp;
                                    <?php }else{?>
                                        <a href="#" data-id="<?=$model['id']?>" class="disable"><span class="btn btn-danger btn-sm">禁用</span></a>&nbsp;
                                    <?php }?>
                                </td>
                                <td>
                                    <a href="<?= Url::to(['edit','id'=>$model['id']])?>""><span class="btn btn-info btn-sm">修改</span></a>&nbsp;
                                    <a href="<?= Url::to(['coin-delete','id'=>$model['id']])?>"  onclick="rfDelete(this);return false;"><span class="btn btn-warning btn-sm">删除</span></a>&nbsp;
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12">
                            <?= LinkPager::widget([
                                'pagination'        => $Pagination,
                                'maxButtonCount'    => 5,
                                'firstPageLabel'    => "首页",
                                'lastPageLabel'     => "尾页",
                                'nextPageLabel'     => "下一页",
                                'prevPageLabel'     => "上一页",
                            ]);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script>


    $(function () {
        $(".coin_text").click(function () {
            var textarea_html = $(this).attr('data-text');

            var coin_name = $(this).attr('data-name');
            $("#myModalLabel").html(coin_name);
            $("#coin_text_modal").html(textarea_html)
        })


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
                    url: "coin-enable",
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
                    url:"coin-enable",
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
    })

</script>
