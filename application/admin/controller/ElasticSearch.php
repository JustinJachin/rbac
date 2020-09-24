<?php
namespace app\admin\controller;

use Elasticsearch\ClientBuilder;
use think\Controller;
/**
 * 
 */
class ElasticSearch extends Controller
{
	
	public function creat(){
        $esclient = ClientBuilder::create()
            ->setHosts(["127.0.0.1:9200"])
            ->build();
        $data = DB::table('user')->get();
 
        // 单次插入
 
/*        foreach($data as $k=>$v) {
            $params = [
                'index' => 'shop',
                'type' => 'user',
                'id' => $v->id,
                ];
                unset($v->id);
                foreach($v as $kk => $vv){
                    $params['body'][$kk] = $vv;
                }
            $res = $esclient->index($params);
        }*/
 
        // 批量分次插入
 
/*        $arr = [];
        foreach($data as $k=>$v){
            $arr[]['index'] = ['_id' => $v->id];
            $arr2 = [];
            foreach($v as $kk=>$vv){
                $arr2[$kk] = $vv;
            }
            $arr[] = $arr2;
        }
        //print_r(count($arr)/2/6);exit;
        $num = 6;  //设置多少条插入一次
        $count = count($arr)/2/$num;
        $res = [];
        for($i=0;$i<$count;$i++){
            $new_arr = [];
            $j = $i*2*$num;
            $jj = ($i+1)*2*$num;
            for($j;$j<$jj;$j++){
                $new_arr[] = $arr[$j];
            }
            $params = [
                'index' => 'my_indexa',
                'type' => 'my_typea',
                'body' => $new_arr
            ];
            $res[] = $esclient->bulk($params);
        }
        print_r($res);exit;*/
 
        //根据id获取
 
/*        $params = [
            'index' => 'shop',
            'type' => 'user',
            'id' => '14',
        ];
        $res = $esclient->get($params);
        print_r($res);exit;*/
 
        //搜索
 
/*        $search_params = [
            'index' => 'shop',
            'type' => 'user',
            'body'=> [
                'query'	=> [
                    'match'	=> [
                        'name'=>'罗'
                    ]
                ]
            ]
        ];
        $res = $esclient->search($search_params);
        print_r($res);*/
 
        //测试分词效果（如果有效果证明安装IK成功）
 
/*        $params = [
            'body' => [
                'text' => '天天敲代码非常高兴',
                'analyzer'=>'ik_max_word' //ik_max_word 精细  ik_smart 粗略
            ]
        ];
        $res =  $esclient->indices()->analyze($params);
        print_r($res);*/
 
        // 创建空索引(必须是新索引名称)
/*        $params = [
            'index' => 'my_index_user4',
        ];
        $res =  $esclient->indices()->create($params);*/
 
        // 创建映射(索引名必须为 my_index_user4)
 
/*        $params = [
            'index' => 'my_index_user4',
            'type' => 'my_type_user4',
            'body' => [
                'my_type_user4' => [
                    '_source' => [
                        'enabled' => true          //可选参数（可以减轻服务器压力）
                    ],
                    'properties' => [
 
                        'contents' => [
                            'type' => 'text', // 字符串型
                            'analyzer'=>'ik_max_word', //ik_max_word 最细粒度拆分 ik_smart最粗粒度拆分
                            'search_analyzer'=> 'ik_max_word'
                        ]
 
                    ]
                ]
            ]
        ];
 
        $res = $esclient->indices()->putMapping($params);*/
 
        // 批量分次插入(索引名必须为 my_index_user4)
 
      /*  $data1 = DB::table('elastic_test')->get();
        $arr = [];
        foreach($data1 as $k=>$v){
            $arr[]['index'] = ['_id' => $v->id];
            $arr2 = [];
            foreach($v as $kk=>$vv){
                $arr2[$kk] = strval($vv);    //因为搜索对整形无效所以把数值都改成字符串（根据需要添加即可）
            }
            $arr[] = $arr2;
        }
        $num = 6;  //设置多少条插入一次
        $count = count($arr)/2/$num;
        $res = [];
        for($i=0;$i<$count;$i++){
            $new_arr = [];
            $j = $i*2*$num;
            $jj = ($i+1)*2*$num;
            for($j;$j<$jj;$j++){
                $new_arr[] = $arr[$j];
            }
            $params = [
                'index' => 'my_index_user4',
                'type' => 'my_type_user4',
                'body' => $new_arr
            ];
            $res[] = $esclient->bulk($params);
        }
        print_r($res);exit;*/
 
        //搜索(索引名必须为 my_index_user4)
 
        $search_params = [
            'index' => 'my_index_user4',
            'type' => 'my_type_user4',
            'body' => [
                'from' => 4,
                'size' => 3,          //分页展示，from相当于分页中的偏移量，size相当于每页展示的条数
                'query' => [
                    'match' => [
                        'contents' =>['query'=>'今天好好','operator' => 'AND'] //所有关键词都必须出现 可以不连续(默认是有一个词就匹配到)
                    ]
                ]
//                 'query' => [
//                    'match_phrase' => [                //必须完全匹配
//                        'contents' =>  '今天天气'
//                    ]]
 
//                    'query' => [                      //通配符查询  
//                      'wildcard' => [
//                        'name' =>  '*user*'           //?代表站一个字符如'???2345*'这是匹配第四位跟第7位是2345的，**类似于sql里面like中的%%的用法
//                    ]]
//                    'query' => [                      //正则匹配  
//                      'regexp' => [
//                        'phone' =>  '135.*'           //匹配以135开头的
//                    ]]
            ,
                //设置高亮
                "highlight" => [
                    "pre_tags" => [
                        '<span style="color:red">'
                    ],
                    "post_tags" => [
                        '</span>'
 
                    ],
                    'fields'=> [
                        'contents' => new \stdClass()
                    ]
                ]
            ]
        ];
        $res = $esclient->search($search_params);
        print_r($res);
    }

}