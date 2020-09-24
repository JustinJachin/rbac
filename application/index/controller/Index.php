<?php
namespace app\index\controller;
use app\index\controller\Base;

require '../vendor/autoload.php';
use Elasticsearch\ClientBuilder;
class Index extends Base{
    public function index(){
        return view('index');
    }

	private $client;
    // 构造函数
    public function __construct()
    {
        $params = array(
            '127.0.0.1:9200'
        );
        $this->client = ClientBuilder::create()->setHosts($params)->build();
    }
 
    // 创建索引
    public function indexs() { // 只能创建一次
 
		// $r = $this->delete_index();/*这个是用作测试的，因为你每次测试他都创建索引，所以当发生索引不存在的时候你可以注释这行，因为索引只能创建一次，所以说每次执行代码的时候都要先删除原创建的索引*/
 
        // $r = $this->create_index();  //1.创建索引,索引就是数据库中的数据库概念
 
        // $r = $this->create_mappings(); //2.创建文档模板，这个就是数据库中的表的概念
 
 
        // $r = $this->get_mapping(); ps.product_id,p.name,p.main_images,ps.sell_price,ps.id as sku_id
 
 
    //     $docs = [];
    //     $docs[] = ['id'=>1,'name'=>'小明','profile'=>'我做的ui界面强无敌。','age'=>23];
    //     $docs[] = ['id'=>2,'name'=>'小张','profile'=>'我的php代码无懈可击。','age'=>24];
    //     $docs[] = ['id'=>3,'name'=>'小王','profile'=>'C的生活，快乐每一天。','age'=>29];
    //     $docs[] = ['id'=>4,'name'=>'小赵','profile'=>'就没有我做不出的前端页面。','age'=>26];
    //     $docs[] = ['id'=>5,'name'=>'小吴','profile'=>'php是最好的语言。','job'=>21];
    //     $docs[] = ['id'=>6,'name'=>'小翁','profile'=>'别烦我，我正在敲bug呢！','age'=>25];
    //     $docs[] = ['id'=>7,'name'=>'小杨我','profile'=>'为所欲为，不行就删库跑路','age'=>27];
 
    //     foreach ($docs as $k => $v) {
    //         $r = $this->add_doc($v['id'],$v);   //3.添加文档
    //     }
  		// $r = $this->search_doc("删库 我");  //4.搜索结果
    //     print_r($r);
    }
 
    // 创建索引
    public function create_index($index_name = 'test_ik') { // 只能创建一次
        $params = [
            'index' => $index_name,
            'body' => [
                'settings' => [
                    'number_of_shards' =>1,
                    'number_of_replicas' => 0
                ]
 
            ],
 
        ];
        // return $this->client->indices()->create($params);
		try {
            return $this->client->indices()->create($params);
        } catch (Elasticsearch\Common\Exceptions\BadRequest400Exception $e) {
            $msg = $e->getMessage();
            $msg = json_decode($msg,true);
            return $msg;
        }
        //     $params = [
	    //         'index' => 'test', //索引名称
	    //         'body' => [
	    //             'settings'=> [ //配置
	    //                 'number_of_shards'=> 3,//主分片数
	    //                 'number_of_replicas'=> 1 //主分片的副本数
	    //             ],
	    //             'mappings'=> [  //映射
	    //                 '_default_' => [ //默认配置，每个类型缺省的配置使用默认配置
	    //                     '_all'=>[   //  关闭所有字段的检索
	    //                         'enabled' => 'false'
	    //                     ],
	    //                     '_source'=>[   //  存储原始文档
	    //                         'enabled' => 'true'
	    //                     ],
	    //                     'properties'=> [ //配置数据结构与类型
	    //                         'name'=> [ //字段1
	    //                             'type'=>'string',//类型 string、integer、float、double、boolean、date
	    //                             'index'=> 'analyzed',//索引是否精确值  analyzed not_analyzed
	    //                         ],
	    //                         'age'=> [ //字段2
	    //                             'type'=>'integer',
	    //                         ],
	    //                         'sex'=> [ //字段3
	    //                             'type'=>'string',
	    //                             'index'=> 'not_analyzed', 
	    //                         ],
	    //                     ]
	    //                 ],
	    //                 'my_type' => [ 
	    //                     'properties' => [
	    //                         'phone'=> [ 
	    //                             'type'=>'string',
	    //                         ],                            
	    //                     ]
	    //                 ],
	    //             ],
	    //         ]
	    //     ];
 
    }
 
    // 删除索引
    public function delete_index($index_name = 'test_ik') {
        $params = ['index' => $index_name];
        $response = $this->client->indices()->delete($params);
        return $response;
    }
 
    // 创建文档模板
    public function create_mappings($type_name = 'users',$index_name = 'test_ik') {
 
        $params = [
            'index' => $index_name,//这里是索引名，相当于数据库名
            'type' => $type_name,//这里是类型名，相当于表名
 
            'body' => [
				//下面是数据类型定义，相当于数据库字段
                'properties' => [
                    'id' => [
                        'type' => 'long', // 整型
                        'index' => 'false', // 非全文搜索
                    ],
                    'name' => [
                        'type' => 'text', // 字符串型
                        'index' => 'true', // 全文搜索
                        'analyzer' => 'ik_max_word'
                    ],
                    'profile' => [
                        'type' => 'text',// 字符串型
                        'index' => 'true', // 全文搜索
                        'analyzer' => 'ik_max_word'
                    ],
                    'age' => [
                        'type' => 'integer',
                        'index' => 'false', //非 全文搜索
                    ],
                ]
 
            ]
 
        ];
 
        $response = $this->client->indices()->putMapping($params);
        return $response;
    }
 
    // 查看映射，就是相当于数据库的数据结构
    public function get_mapping($type_name = 'users',$index_name = 'test_ik') {
        $params = [
            'index' => $index_name,
            'type' => $type_name
        ];
        $response = $this->client->indices()->getMapping($params);
        return $response;
    }
 
    // 添加文档
    public function add_doc($id,$doc,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id,
            'body' => $doc
        ];
 
        $response = $this->client->index($params);
        return $response;
    }
 
    // 判断文档存在
    public function exists_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id
        ];
 
        $response = $this->client->exists($params);
        return $response;
    }
 
 
    // 获取文档
    public function get_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id
        ];
 
        $response = $this->client->get($params);
        return $response;
    }
 
    // 更新文档
    public function update_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        // 可以灵活添加新字段,最好不要乱添加
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id,
            'body' => [
                'doc' => [  //将doc中的文档与现有文档合并
                    'name' => '大王'
                ]
            ]
        ];
 
        $response = $this->client->update($params);
        return $response;
    }
 
    // 删除文档
    public function delete_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id
        ];
 
        $response = $this->client->delete($params);
        return $response;
    }
 
    // 查询文档 (分页，排序，权重，过滤)
    public function search_doc($keywords = "删库",$index_name = "test_ik",$type_name = "users",$from =0,$size = 10) {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'body' => [
                'query' => [
                    'bool' => [//bool查询，可以把很多小的查询组成一个更为复杂的查询，
                        'should' => [// 这里should是查询profile字段包含$keywords关键词或者name字段包含$keywords关键词的文档。可以改为"must"意思是同时包含。must_not排除包含
                            [ 'match' => [ 'profile' => [
                                'query' => $keywords,
                                'boost' => 3, // 权重大
                            ]]],
                            [ 'match' => [ 'name' => [
                                'query' => $keywords,
                                'boost' => 2,
                            ]]],
                        ],
                    ],
                ],
                'highlight' => [  //高亮部分
                	'pre_tags'  => ["<em>"],
                	'post_tags' => ["</em>"],
                	'fields'    => [
                		"profile"  => new \stdClass(),
                		"name"  => new \stdClass(),
                	]
                ],
                'sort' => ['age'=>['order'=>'desc']]
                , 'from' => $from, 'size' => $size
            ]
        ];
 
 
 
        $results = $this->client->search($params);
        return $results;
    }

}
	
// 	private $client;
//     // 构造函数
//     public function __construct()
//     {
//         $params = array(
//             '127.0.0.1:9200'
//         );
//         $this->client = ClientBuilder::create()->setHosts($params)->build();
//     }
 
//     // 创建索引
//     public function index() { // 只能创建一次
 
//         $r = $this->delete_index();
 
//         $r = $this->create_index();  //1.创建索引
 
//         $r = $this->create_mappings(); //2.创建文档模板
 
 
//         $r = $this->get_mapping();
 
 
//         $docs = [];
//         $docs[] = ['id'=>1,'name'=>'小明','profile'=>'我做的ui界面强无敌。','age'=>23];
//         $docs[] = ['id'=>2,'name'=>'小张','profile'=>'我的php代码无懈可击。','age'=>24];
//         $docs[] = ['id'=>3,'name'=>'小王','profile'=>'C的生活，快乐每一天。','age'=>29];
//         $docs[] = ['id'=>4,'name'=>'小赵','profile'=>'就没有我做不出的前端页面。','age'=>26];
//         $docs[] = ['id'=>5,'name'=>'小吴','profile'=>'php是最好的语言。','job'=>21];
//         $docs[] = ['id'=>6,'name'=>'小翁','profile'=>'别烦我，我正在敲bug呢！','age'=>25];
//         $docs[] = ['id'=>7,'name'=>'小杨','profile'=>'为所欲为，不行就删库跑路','age'=>27];
 
//         foreach ($docs as $k => $v) {
//             $r = $this->add_doc($v['id'],$v);   //3.添加文档
//         }
 
//         $r = $this->search_doc("删库 别烦我");  //4.搜索结果
//         var_dump($r);
//     }
 
//     // 创建索引
//     public function create_index($index_name = 'test_ik') { // 只能创建一次
//         $params = [
//             'index' => $index_name,
//             'body' => [
//                 'settings' => [
//                     'number_of_shards' => 5,
//                     'number_of_replicas' => 0
//                 ]
//             ]
//         ];
 
//         try {
//             return $this->client->indices()->create($params);
//         } catch (Elasticsearch\Common\Exceptions\BadRequest400Exception $e) {
//             $msg = $e->getMessage();
//             $msg = json_decode($msg,true);
//             return $msg;
//         }
//     }
 
//     // 删除索引
//     public function delete_index($index_name = 'test_ik') {
//         $params = ['index' => $index_name];
//         $response = $this->client->indices()->delete($params);
//         return $response;
//     }
 
//     // 创建文档模板
//     public function create_mappings($type_name = 'users',$index_name = 'test_ik') {
 
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'body' => [
//                 $type_name => [
//                     '_source' => [
//                         'enabled' => true
//                     ],
//                     'properties' => [
//                         'id' => [
//                             'type' => 'integer', // 整型
//                             'index' => 'not_analyzed',
//                         ],
//                         'name' => [
//                             'type' => 'string', // 字符串型
//                             'index' => 'analyzed', // 全文搜索
//                             'analyzer' => 'ik_max_word'
//                         ],
//                         'profile' => [
//                             'type' => 'string',
//                             'index' => 'analyzed',
//                             'analyzer' => 'ik_max_word'
//                         ],
//                         'age' => [
//                             'type' => 'integer',
//                         ],
//                     ]
//                 ]
//             ]
//         ];
 
//         $response = $this->client->indices()->putMapping($params);
//         return $response;
//     }
 
//     // 查看映射
//     public function get_mapping($type_name = 'users',$index_name = 'test_ik') {
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name
//         ];
//         $response = $this->client->indices()->getMapping($params);
//         return $response;
//     }
 
//     // 添加文档
//     public function add_doc($id,$doc,$index_name = 'test_ik',$type_name = 'users') {
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'id' => $id,
//             'body' => $doc
//         ];
 
//         $response = $this->client->index($params);
//         return $response;
//     }
 
//     // 判断文档存在
//     public function exists_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'id' => $id
//         ];
 
//         $response = $this->client->exists($params);
//         return $response;
//     }
 
 
//     // 获取文档
//     public function get_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'id' => $id
//         ];
 
//         $response = $this->client->get($params);
//         return $response;
//     }
 
//     // 更新文档
//     public function update_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
//         // 可以灵活添加新字段,最好不要乱添加
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'id' => $id,
//             'body' => [
//                 'doc' => [
//                     'name' => '大王'
//                 ]
//             ]
//         ];
 
//         $response = $this->client->update($params);
//         return $response;
//     }
 
//     // 删除文档
//     public function delete_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'id' => $id
//         ];
 
//         $response = $this->client->delete($params);
//         return $response;
//     }
 
//     // 查询文档 (分页，排序，权重，过滤)
//     public function search_doc($keywords = "运维",$index_name = "test_ik",$type_name = "users",$from = 0,$size = 10) {
//         $params = [
//             'index' => $index_name,
//             'type' => $type_name,
//             'body' => [
//                 'query' => [
//                     'bool' => [
//                         'should' => [
//                             [ 'match' => [ 'profile' => [
//                                 'query' => $keywords,
//                                 'boost' => 3, // 权重大
//                             ]]],
//                             [ 'match' => [ 'name' => [
//                                 'query' => $keywords,
//                                 'boost' => 2,
//                             ]]],
//                         ],
//                     ],
//                 ],
//                 'sort' => ['age'=>['order'=>'desc']]
//                 , 'from' => $from, 'size' => $size
//             ]
//         ];
 
//         $results = $this->client->search($params);
//         return $results;
//     }
 

// }
