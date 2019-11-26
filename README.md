
店神器流量接口SDK
===============


## 使用

1、注册平台账户-》创建应用-》获取API KEY和API Secret


2、下载代码放到您的项目中，修改SDK.PHP文件里面的API KEY和API Secret为您创建的


3、代码中引用，参考接口文档参数进行调用

thinkphp使用例子：

把dsq文件夹放到thinkphp项目的extend目录下，修改dsq\sdk.php里面的API_KEY和API_SECRET，然后在控制器中使用：

1、获取账户剩余点数

~~~
$dsq=new \dsq\Sdk();
$res=$dsq->request('GetTrafficSum');
~~~

2、创建查询信息接口-查询店铺信息、商品信息、淘口令信息、直播间信息等需要先创建查询信息，然后通过返回的gid调用信息查询接口

~~~
public function set_business(){
    $params=[
        'share_password'=>'https://detail.tmall.com/item.htm?id=565324528679',// 链接或者淘口令
        'type'=>1 //任务类型 https://open.dianshenqi.com/help/api_doc/d2169062676641fe99caa9b40f54bef1#article-h589
    ];
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('SetBusinessData',$params,'v2');
}
~~~

3、获取查询信息-查询店铺信息、商品信息、淘口令信息、直播间信息等需要先创建查询信息，然后通过返回的gid调用信息查询接口

~~~
public function get_business(){
    $params['gid']='386e3cb7f8344bea96f473c4612f7f2b';//创建查新订单接口返回的gid
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('GetBusinessData',$params,'v2');
}
~~~

4、发布APP流量任务

~~~
public function release_app(){
    $params=[
        'number'=>'APP456462345465',// 任务编号-请自行生成并且保证唯一性
        'user_name'=>'e10adc3949ba59abbe56e057f20f883e',//用户名，主要作用为分配买号时候去重，也可用作任务记录。如开发者担心自身产品用户名暴露，可做处理后传入，但是最好保证处理后仍能保证唯一性。
        'url'=>'565324528679',//宝贝ID（淘口令来路任务url必须是淘口令）,可通过查询信息接口获取
        'start_time'=>'2020-01-01',//任务开始时间，以天为单位
        'end_time'=>'2020-01-01',//任务结束时间，以天为单位
        'type'=>1,//任务类型
        'referers'=>[//来路类型
            [
                'referer'=>'1',//来路类型 1 - 手淘搜索 2 - 猜你喜欢（手淘首页） 3 - 直通车 4 - 淘口令 5 - 手淘淘金币
                'keyword'=>'电风扇',//搜索关键词
                'sub_tasks'=>[//数量分配
                    [
                        'day'=>'2020-01-01',//执行时间
                        'hours'=>[0,0,0,0,0,0,0,0,0,0,0,0,0,0,15,15,14,12,12,9,8,6,5,4]//0点到23点的每小时的流量数
                    ],
                    [
                        'day'=>'2020-01-02',//执行时间
                        'hours'=>[0,0,0,0,0,0,0,0,0,0,0,0,0,0,15,15,14,12,12,9,8,6,5,4]//0点到23点的每小时的流量数
                    ]
                ]
            ]
        ],//来路类型
        'shop_name'=>'2383574075',//主要作用为分配买号时候去重，也可用作任务记录。每个任务类型传值详见平台文档任务类型表,可通过查询信息接口获取
        'goods_browsing_time'=>50,//主商品浏览停留时间，单位秒
        'visit_mode'=>0,//商品浏览模式 详见平台商品浏览模式表
        'shop_browsing_time'=>30,//店铺其他商品浏览停留时间，仅当商品浏览模式设定了浏览多个商品时有效
        'is_compare'=>true//是否在搜索后货比三家
    ];
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('ReleaseTraffic',$params,'v2');
}
~~~

5、获取任务列表

~~~
public function task_list(){
    $params=[
        'current_page'=>1,//当前页码
        'page_size'=>20,//每页条数
        'user_name'=>'e10adc3949ba59abbe56e057f20f883e',//通过用户名进行查询
        'shop_name'=>'',//通过发布任务的shop_name进行查询
        'number'=>''//通过
    ];
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('GetTrafficPage',$params);
}
~~~

6、关闭任务

~~~
public function task_close(){
    $params=[
        'number'=>'SQ456462345465'//任务编号
    ];
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('TrafficClose',$params);
}
~~~

7、获取任务详情

~~~
public function task_detail(){
    $params=[
        'number'=>'SQ456462345465'//任务编号
    ];
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('GetTaskTrafficRow',$params);
}
~~~

8、按时间段查询消耗的流量点数(最近3个月内的数据)

~~~
public function consume_sum(){
    $params=[
        'start_time'=>'2019-10-01',//开始时间
        'end_time'=>'2019-12-31'//结束时间
    ];
    $dsq=new \dsq\Sdk();
    $res=$dsq->request('GetTrafficConsumeSum',$params);
}
~~~

## 更多接口请求方法请参考thinkphp版的SDK例子

+ [demo](https://github.com/ansu2009/dsq_sdk_demo)


