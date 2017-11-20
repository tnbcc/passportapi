<?php $__env->startSection('title', '首页'); ?>

<?php $__env->startSection('css'); ?>
  <link href="<?php echo e(loadEdition('/admin/css/pxgridsicons.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
  <div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol userblue">
          <i class="icon-users"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count1">1</h1></a>
          <p>用户总量</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol commred">
          <i class="icon-user-add"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count2">56</h1></a>
          <p>今日注册用户</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol articlegreen">
          <i class="icon-check-circle"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count3">1876</h1></a>
          <p>笑话总数</p>
        </div>
      </section>
    </div>
    <div class="col-lg-3 col-sm-6">
      <section class="panel">
        <div class="symbol rsswet">
          <i class="icon-file-word-o"></i>
        </div>
        <div class="value">
          <a href="#"><h1 id="count4">3</h1></a>
          <p>待审核笑话总数</p>
        </div>
      </section>
    </div>
  </div>
  <div class="row">
    <!-- 表单 -->
    <div class="col-lg-6">
      <section class="panel">
        <header class="panel-heading bm0">
          <span><strong>最新发布内容</strong></span>
          <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>

        </header>
        <div class="panel-body" id="panel-bodys" style="display: block;">
          <table class="table table-hover personal-task">
            <tbody>
            <volist name="jokelist" id="v">
              <tr>
                <td>{$v.type|getjokecate}</td>
                <td><a href="{:U('/admin/joke/edit',array('id'=>$v['id']))}">{$v.title|mb_substr=0,50,'UTF-8'}</a></td>
                <td width="110">{$v.create_time|date='m-d H:i:s',###}</td>
              </tr>
            </volist>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!-- 表单 -->

    <!-- 版权信息 -->
    <div class="col-lg-6">
      <section class="panel">
        <header class="panel-heading bm0">
          <span><strong>团队及版权信息</strong></span>
          <span class="tools pull-right">
                                <a class="icon-chevron-down" href="javascript:;"></a>
                            </span>
        </header>
        <div class="panel-body" id="panel-bodys" style="display: block;">
          <table class="table table-hover personal-task">
            <tbody>
            <tr>
              <td>
                <strong>检测更新</strong>：已是最新版
              </td>
              <td></td>
            </tr>
            <tr>
              <td><strong>程序名称</strong>：源神CMS笑话系统 </td>
              <td></td>
            </tr>
            <tr>
              <td><strong>当前版本</strong>：V4.4</td>
              <td></td>
            </tr>
            <tr>
              <td><strong>开发团队</strong>：梦龙、背着棺材跳舞 、翱翔蔚蓝 </td>
              <td></td>
            </tr>
            <tr>
              <td><strong>版权所有</strong>：<a href="http://www.168282.com" target="_bliank">安徽源神网络科技有限公司</a> </td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>操作系统：</strong>：<?php echo e(PHP_OS); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>WEB服务器</strong>：<?php echo e(php_sapi_name()); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>PHP版本</strong>：<?php echo e(PHP_VERSION); ?></td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>MySQL版本</strong>：{$mysql}</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>官方网址</strong>：http://www.168282.com</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>客服QQ</strong>：4008885302</td>
              <td></td>
            </tr>
            <tr>
              <td>
                <strong>服务热线</strong>：400-888-5302</td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
    <!-- 版权信息 -->
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="ibox-title">
        <h5>系统更新日志</h5>
      </div>
      <div class="ibox-content timeline">
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2017年3月30日更新</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V4.4</strong>
              </p>
              <p>
                1、修复后台开启水印时缺少字体 √<br>
                1、修复视频上传到七牛云后没有后缀导致手机端无法播放 √<br>
                2、填加了火车头采集后台生成GIF缩略图 √<br>
                3、填加了定时任务审核功能 √<br>
                4、修复了后台一些样式问题 √<br>
                5、修复了安装软件的流程！√<br>
                6、PC+WAP端发布页一处BUG修复√<br>
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2017年1月24日更新</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V4.3</strong>
              </p>
              <p>
                1、修复微博登录无法获取头像和名称 √<br>
                1、修复手机端和PC端的微博登录无法获取头像名称等问题   √<br>
                2、后台-》去掉配置第三方登录必填问题,提示文字也有问题需要处理 √<br>
                3、QQ登录老是报错，字段不为空 √<br>
                4、后台修改图片和视频帖子，保存后前台缩略图没有了，但是点击播放可以正常显示。√<br>
                5、个人资料页面所有人的性别都是男。（微信登录）！√<br>
                6、微信登录，注册时间全为1970年1月1日。√<br>
                7、通过微博登录的用户没有等级变化，在线时间一直都是0分钟！！√<br>
                8、评论内容点赞会报错 √<br>
                9、时间方面有问题 √<br>
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2017年1月10日更新</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V4.2</strong>
              </p>
              <p>
                1、QQ登录和微博登录BUG修复 √<br>
                2、视频播放器升级  √<br>
                3、长图片下拉收缩 √<br>
                4、增加系统保留用户名过滤效果 √<br>
                5、在有些环境下 install.php 运行不了已修复√<br>
                6、手机和PC发布内容时，在七牛云存储模式下有部分BUG。  √<br>
                7、上传前端方法调整（所有页面的上传类已修复） √<br>
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2017年1月3日更新</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V4.1</strong>
              </p>
              <p>
                1、后台网站关键字不能保存 √<br>
                2、水印的右下角和下居中不能通过后台保存  √<br>
                3、增加了神回复的积分设置 √<br>
                4、设置被包养后，前台显示的包养积分和设置的积分不匹配 √<br>
                5、关闭站点，前台报错√<br>
                6、前台--积分规则页面在点击积分规则后跳转到/about/jiongbi.html 页面链接错误  √<br>
                7、后台修改视频帖子  如果更改视频地址 也是无法保存的 √<br>
                8、审稿  页面  动图不播放 √<br>
                9、评论后弹出错误 √<br>
                10、后台发布内容时前台显示的时间不对 √<br>
                11、微信的接口需要提示下，在微信配置那块 √<br>
                12、找回密码有问题，点击没反应 √  <br>
                13、成为神回复没有增加积分 √<br>
                14、再次发送邮件不行 √<br>
                15、手机端上传GIF图片不保存缩略图 √<br>
                16、栏目SEO没调出来 √<br>
                17、手机端 PC端 相互跳转 √<br>
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2016年12月份</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V4.0</strong>
              </p>
              <p>
                1、后台管理系统全面升级，功能更强，管理更灵活<br>
                2、对接了QQ空间，让系统在营销推广方面更得心应手，获取更多的流量<br>
                3、对接了微信公众号，让系统真正的跟粉丝互动<br>
                4、增加了段子、趣图、GIF动图、视频的二级分类（利于SEO优化）<br>
                5、优化了模板中代码其对SEO更友好<br>
                6、增加了极验证和普通验证后台切换<br>
                7、增加了模板后台管理功能，编辑模板可以直接后台操作了<br>
                8、增加了性能优化（开启和关闭模板编译缓存功能，开启和关闭HTML静态缓存功能）提升了打开速度，跟生成HTML的速度一样。<br>
                9、URL伪静态配置可以从后台直接配置（按自己的需求设置）利于SEO<br>
                10、数据库管理（备份、优化、修复、运行SQL命令、批量替换）等功能<br>
                11、扩展功能增加了（搜索词记录、内链、敏感词）等功能，优化了广告系统<br>
                12、增加了三个七牛云存储配置样式
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2016年9月份</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V3.0</strong>
              </p>
              <p>
                1、七牛云和本地储存，后台一键切换。<br>
                2、手机电脑都可以上传小视频，可以录好后上传。也可以外链视频网站的（增加了全功能云播放器）<br>
                3、增加了6套PC端模板风格<br>
                4、增加了多图片滚动效果<br>
                5、增加粉丝功能，可以关注我喜欢的用户，这样就可以看到他们推送的内容（我的关注，我的粉丝）<br>
                6、增加了签到功能<br>
                7、全新升级了后台管理功能<br>
                8、增加了APP下载页面<br>
                9、优化了站内SEO
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2016年7月份</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>源神CMS笑话系统V2.0（虾囧更名为源神CMS笑话系统）</strong>
              </p>
              <p>
                1、会员中心（发帖、审贴、动态、我的投稿、站内消息、我的礼品(积分记录、兑换记录)、个人资料(资料修改、头像修改、密码修改) 、关注）<br>
                2、前台（笑点、登陆、注册、找回密码、第三方登陆绑定）打赏功能<br>
                3、第三方（QQ登陆、微博登陆 ）积分系统（兑换、签到、邀请）<br>
                4、内容功能（文字、图片、动态GIF、视频）广告系统、积分商城<br>
                5、后台可切换上传方式：本地存储 <br>
                6、系统带每隔多长时间自动审核信息到前台<br>
                7、火车头采集入库随机关联用户。<br>
                8、用户手机端也可以发布内容哟！
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2016年5月份</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>虾囧CMSV1.5</strong>
              </p>
              <p>
                增加了 打赏、评论、QQ登录、微博登录、手机版<br>
                网址：http://m.xiajiong.com
              </p>
            </div>
          </div>
        </div>
        <div class="timeline-item">
          <div class="row">
            <div class="col-xs-3 date">
              <i class="fa fa-file-text"></i>
              <small class="text-navy">2015年10月份</small>
            </div>
            <div class="col-xs-7 content">
              <p class="m-b-xs"><strong>虾囧CMSV1.0诞生</strong>
              </p>
              <p>
                有段子、趣图、GIF动图、视频、笑点、神回复、积分商城等栏目<br>
                网址：http://www.xiajiong.com
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>