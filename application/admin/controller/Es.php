<?php
namespace app\index\controller;

use Elasticsearch\ClientBuilder;
use think\Controller;
use think\facade\Env;

class Index extends Controller
{
    private static $esClient;

    public function __construct(){
        if (!self::$esClient) {
            //此处为调用根目录下的.env中的配置，如不需要这种方式，可直接写死 $host = "192.168.0.12:9200"; 以实际ip为准
            $host = Env::get('ELASTIC_HOST').':'.Env::get('ELASTIC_PORT');
            self::$esClient = ClientBuilder::create()->setHosts([$host])->build();
        }
    }

    public function index(){
        //获取所有索引
        // $this->get_all();

        //创建索引
        // $this->create_index();

        //创建索引指定type
        // $this->create_index_with_mapping();

        //删除索引
        // $this->delete_index();

        //创建文档
        // $this->create_doc();

        //创建文档指定type
        // $this->create_doc_with_type();

        // 查找所有文档
        // $this->get_all_doc();

        //查找文档
        // $this->search_doc();

        //更新文档
        // $this->update_doc();

        //删除文档
        // $this->delete_doc();

        //批量删除 todo 该方法删除失败，待完善
        $this->delete_all_doc();
    }

    //获取所有索引
    public function get_all(){
        $response = self::$esClient->indices()->get();
dump($response);
    }

    // 创建索引
    public function create_index()
    {
        $params = [
            'index' => 'person',
            'body' => [
                'settings' => [
                    'number_of_shards' => 5, // 分片 默认5
                    'number_of_replicas' => 0 // 副本、备份 默认1
                ]
            ]
        ];

        $params_search = [
            'index' => 'person'
        ];

        $flag_exit = self::$esClient->indices()->exists($params_search);

        if($flag_exit == false)
        {
            $response = self::$esClient->indices()->create($params);
dump($response);
        }else{
            echo "该索引已存在";
        }
    }

    //创建索引指定type
    public function create_index_with_mapping(){
        $params = [
            'index' => 'animal',
            'body' => [
                'mappings' => [
                    'cat' => [
                        'properties' => [
                            'name' => [
                                'type' => 'text'
                            ],
                            'age' => [
                                'type' => 'integer'
                            ]
                        ]
                    ]
                ],
                'settings' => [
                    'number_of_shards' => 5, // 分片 默认5
                    'number_of_replicas' => 0 // 副本、备份 默认1
                ]
            ]
        ];

        // $params_search = [
        //     'index' => 'person',
        //     'mapping' => [
        //         'index' => 'man'
        //     ]
        // ];

        // $flag_exit = self::$esClient->indices()->exists($params_search);
        //
        // if($flag_exit == false)
        // {
            $response = self::$esClient->indices()->create($params);
dump($response);
        // }else{
        //     echo "该索引已存在";
        // }
    }

    //删除索引
    public function delete_index(){
        $params = [
          'index' => 'test'
        ];

        $flag_exit = self::$esClient->indices()->exists($params);

        if($flag_exit == true)
        {

            $response = self::$esClient->indices()->delete($params);
dump($response);
        }else{
            echo "对应索引不存在";
        }
    }

    ////////////////////////////////////文档相关///////////////////////////////////////
    //创建文档
    public function create_doc(){
        $params = [
            'index' => 'person',
            'body' => [
                'first_name' => 'Eric',
                'last_name' => 'swith',
                'age' => 23,
                'about' => 'I love basketball',
                "interests" =>[
                    "sports",
                    "reading"
                ]
            ]
        ];

        $response = self::$esClient->index($params);
dump($response);
    }

    //创建文档指定type
    public function create_doc_with_type(){
        $params = [
            'index' => 'animal',
            'type' => 'cat',
            'body' => [
                'name' => '哆啦A梦',
                'age' => 43
            ]
        ];

        $response = self::$esClient->index($params);
dump($response);
    }

    //查找所有文档
    public function get_all_doc(){
        $params['index'] = 'person';

        $response = self::$esClient->search($params);
        dump($response);
    }

    //查找文档
    public function search_doc(){
        $params['index'] = 'person';
        $params['body']['query']['match']['first_name'] = 'john';

        $response = self::$esClient->search($params);
dump($response);
    }

    //更新文档
    public function update_doc(){
        $params = [
            'id' => 'eM-VvnEB7cL0Y_uMtRT_',
            'index' => 'animal',
            'type' => 'cat',
            'body' => [
                'doc' => [
                    'age' => 20
                ]
            ]
        ];

        $response = self::$esClient->update($params);
dump($response);
    }

    //删除文档
    public function delete_doc(){
        $params['index'] = 'person';
        $params['id'] = 'dM9qvnEB7cL0Y_uMQBS9';

        $flag = self::$esClient->delete($params);
dump($flag);
    }

    //批量删除
    public function delete_all_doc(){
        $params = [
            'index' => 'animal',
            'type' => 'cat',
            'body' => [
                'query' => [
                    'match_all' => []
                ]
            ]
        ];

        $response = self::$esClient->deleteByQuery($params);
dump($response);
    }
}