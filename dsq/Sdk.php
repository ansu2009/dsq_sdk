<?php
namespace dsq;

class Sdk{ 
    
    const API_KEY = 'XXXXXXXXXXXXXXXXXXXXXX';
    const API_SECRET = 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
    /**
     * 请求接口
     * @param string $url 接口地址
     * @return array $param 提交参数
    */
    function curl($url,$params=''){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        if($params){
            //设置为POST
            curl_setopt($curl, CURLOPT_POST, 1);
            //把POST的变量加上
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        }
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }
    /**
     * 对象 转 数组
     * @param object $obj 对象
     * @return array
    */
    function request($cmd='',$params='',$version='') {
        $ts=$this->curl('https://api.dianshenqi.com/time/gettime');
        $d=json_encode($params);
        $secret=self::API_SECRET;
        //curl模拟post提交数据
        $url = "https://api.dianshenqi.com/api/".$version;
        $post_data =[
            "c"=>$cmd,
            "d"=>$d,
            "s"=>md5($ts.json_encode($params).$secret),
            "ts"=>$ts,
            "a"=>self::API_KEY
        ];
        $res=$this->curl($url,$post_data);
        $res=json_decode($res);
        return $this->object_to_array($res);
    }
    /**
     * 对象 转 数组
     * @param object $obj 对象
     * @return array
    */
    function object_to_array($obj) {
        $obj = (array)$obj;
        foreach ($obj as $k => $v) {
            if (gettype($v) == 'resource') {
                return;
            }
            if (gettype($v) == 'object' || gettype($v) == 'array') {
                $obj[$k] = (array)$this->object_to_array($v);
            }
        }
        return $obj;
    }
}
