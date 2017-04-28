<?php
class map{
    /*
     * 通过地址获取经纬度
     *
     */
    public static function getCoorByAddress($address){
        //http://api.map.baidu.com/geocoder/v2/?callback=renderOption&output=json&address=百度大厦&city=北京市&ak=您的ak
        $data = [
            'address'=>$address,
            'output'=>'json',
            'ak'=>config('map.ak'),
        ];
        $url = config('map.url').config('map.geocoder').'?'.http_build_query($data);
        $rel = doCurl($url,0);
        return json_decode($rel);
    }
    /*
     * 通过地址或经纬度获取地图
     * center:地图中心点位置，参数可以为经纬度坐标或名称。坐标格式：lng<经度>，lat<纬度>，例如116.43213,38.76623。
     */
    public static function getImageByAddress($center){
        //http://api.map.baidu.com/staticimage/v2?ak=E4805d16520de693a3fe707cdc962045&mcode=666666&center=
        //116.403874,39.914888&width=300&height=200&zoom=11
        $data = [
            'ak'=>config('map.ak'),
            'center'=>$center,
            'width'=>config('map.width'),
            'height'=>config('map.height')
        ];
        $url = config('map.url').config('map.staticimage').'?'.http_build_query($data);
        return doCurl($url);
    }
}