<link href="/resource/frontend/css/uc.css" rel="stylesheet">  
<style type="text/css">
.referer-lead table tbody tr:nth-child(1) td:nth-child(1),.referer-lead table tbody tr:nth-child(2) td:nth-child(1),.referer-lead table tbody tr:nth-child(3) td:nth-child(1) {
    background: none;
    color: #353535;
}
th.header,.referer-lead table tbody tr td ,.referer-lead h3{
    text-align: left;
}
</style>
<div id="main">
    <div class="main_box">
        <?php echo $this->render('left.php'); ?>
        <div class="raise right bg_w clearfix" >
           <div class="tagContent selectTag" id="tagContent0">
            			<form id="signupForm" method="POST">
                			<ul class="ybc_con" style="margin-left: 50px;">
                    	     	<li style="margin:30px 60px;;">
		                        	<label class="buys">&nbsp;</label><input style="width:295px;" name="pwd" id="pwd" type="text" placeholder="请填写申购码" >

		                        </li>

		                        <li style="margin-left:60px;margin-bottom:30px;">
		                        	<label class="buys">&nbsp;</label><input  class="tijiao" data-i18n="u_f_7" value="提交" type="submit" id="tijiao"></input>
		                        </li>
		                    </ul>
            			</form>
        			</div>



        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>

<script type="text/javascript" src="/resource/frontend/js/clipboard.min.js"></script>

<script type="text/javascript">
    function toNonExponential(num) {
        num = num - 0;
        var m = num.toExponential().match(/\d(?:\.(\d*))?e([+-]\d+)/);
        return num.toFixed(Math.max(0, (m[1] || '').length - m[2]));
    }

    $(document).ready(function() {
        http.post('user/invite-info', {
        }, function(res) {
            $(".coin_symbol").html(res.data.coin_symbol);
            $(".level-1").html(res.data.level_1_num);
            $(".level-2").html(res.data.level_2_num);
            $(".level-3").html(res.data.level_3_num);
            $(".rewards-num").html(res.data.invite_rewards);
            $(".rewards-fee").html(res.data.fee_rewards);
            $(".freeze-num").html(res.data.freeze_rewards);
            $(".frozen-num").html(res.data.frozen_rewards);
            $(".code").html(res.data.invite_code);
            $(".link").html(res.data.invite_url);

            $('.link-btn').attr('data-clipboard-text',res.data.invite_url);
            $('.code-btn').attr('data-clipboard-text',res.data.invite_code);
        });

        var clipboard =  new ClipboardJS('.copy-text', {
            text: function(trigger) {
                 return trigger.getAttribute('data-clipboard-text');
            }
        });
        clipboard.on('success', function(e) {
             http.info('复制成功')
        });

        //rank
        http.post('user/myweath', {
        }, function(res) {
            List = res.data;
            var rank_index = 0;
            $.each(List, function(index,r) {
                 rank_index = index +1 ;
                 $('.latest-list-new').append('<tr height="32"><td>'+ r.id +'</td><td>'+ r.name +'</td><td>'+ toNonExponential(r.amount) +'</td><td>'+r.surplus_period+'</td></tr>');
            });
        });

        //rank
        http.post('user/weathpackagelock', {
        }, function(res) {
            List = res.data;
            var rank_index = 0;
            $.each(List, function(index,r) {
                 rank_index = index +1 ;
                 $('.weathpackage').append('<tr height="74"><td>'+ r.name +'</td><td>'+ toNonExponential(r.day_profit) +'%</td><td>类型：'+ r.type +'<br />有效期：'+ r.period +' 天<br />最低数量：'+ toNonExponential(r.min_num) + r.coin_symbol+'</td><td><a style="color: #0770f6; font-weight: bold;" href="/uc/wealthbuy?id='+ r.id +'">购买</a></td></tr>');
            });
        });

        //收益记录
        http.post('user/weathprofit', {
        }, function(res) {
            List = res.data;
            var rank_index = 0;
            $.each(List, function(index,r) {
                 rank_index = index +1 ;
                 $('.weathprofit').append('<tr height="32"><td>'+ r.ctime +'</td><td>'+ r.memo +'</td></tr>');
            });
        });




    });   
</script>