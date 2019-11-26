
店神器流量接口SDK
===============


## 使用

1、注册平台账户-》创建应用-》获取API KEY和API Secret


2、下载代码放到您的项目中，修改SDK.PHP文件里面的API KEY和API Secret为您创建的


3、代码中引用，参考接口文档参数进行调用

thinkphp使用例子：

把dsq文件夹放到thinkphp项目的extend目录下，修改dsq\sdk.php里面的API_KEY和API_SECRET，然后在控制器中使用：

获取账户剩余点数
~~~
$dsq=new \dsq\Sdk();
$res=$dsq->request('GetTrafficSum');
halt($res);
~~~


## 更多接口请求方法请参考thinkphp版的SDK例子

+ [demo](https://github.com/ansu2009/dsq_sdk_demo)


