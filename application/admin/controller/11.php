<?php

namespace Home\Controller;
/**
 * 商品分类
 */
class GoodController extends HomeController
{
	
	/**
     * @ 显示所有分类
     * @param intger 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-13
     **/
    public function category(){
	    $map['pid']=0;
        $map['status']=1;
        $cate=M('product_category')->where($map)->field('id,title')->order('sort asc')->select();
        if(!$cate){
            $msg['code']=false;
            $msg['mes']='暂无分类';
            $this->ajaxReturn($msg);
        }
        foreach ($cate as $key => $value) {
            $maps['pid']=$value['id'];
            $map['status']=1;
            $cate[$key]['child']=M('product_category')->where($maps)->field('id,title')->order('sort asc')->select();
        }
        $msg['code']=true;
        $msg['mes']=$cate;
        $this->ajaxReturn($msg);
	}
    /**
     * @ 根据分类id获取商品
     * @param intger 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-13
     **/
    public function getGood(){
        $cate=I('cate','');
        if(empty($cate)){
            $msg['code']=false;
            $msg['mes']='参数错误';
            $this->ajaxReturn($msg);
        }
        //查看是否有子分类
        $maps['pid']=$cate;
        $cates=M('product_category')->where($maps)->field('id')->select();
        $id='';
        //有子分类就提取id
        if($cates){
            $id=implode(',',array_column($cates, 'id'));
        }
        //拼接cate——id
        if($id){
            $cid=$cate.','.$id;
        }else{
            $cid=$cate;
        }
        //获取商品对应的参数
        $map['ps.cid']=array('in',$cate);
        $map['ps.status']=2;
        $map['p.status']=1;
        $map['ps.inventory']=array('gt',0);
        $product=M('product_specs')->alias('ps')->join('__PRODUCT__ as p on ps.product_id=p.id')->field('ps.product_id,p.name,p.main_images,ps.sell_price,ps.opening_price,ps.id as sku_id')->where($map)->select();
        foreach ($product as $key => $value) {
            $product[$key]['sell_price']=bcdiv($value['sell_price'], 100,2);
            $product[$key]['opening_price']=bcdiv($value['opening_price'], 100,2);
        }
        if($product){
            $msg['code']=true;
            $msg['mes']=$product;
        }else{
            $msg['code']=false;
            $msg['mes']='暂无商品';
        }
        $this->ajaxReturn($msg);
    }
    /**
     * @ 获取所有的商品
     * @param intger 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-17
     **/
    public function getAll(){
        $data=M('product_specs')->alias('ps')->join('__PRODUCT__ as p on ps.product_id=p.id')->field('ps.product_id,p.name,p.main_images,ps.sell_price,ps.opening_price,ps.id')->select();
        return $data;
    }
    /**
     * @ 创建索引
     * @param index_name  索引名 类似数据库名 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function index(){
        $keyword=I('keyword','');
        // var_dump($keyword);exit;
        // $r = $this->delete_index('product_ik');exit;
        // $r = $this->create_index('product_ik');
        // $r = $this->create_mappings('product','product_ik');
        $r = $this->exists_index('product_ik');
        // var_dump($r);exit;
        if(!$r){
            $r = $this->create_index('product_ik'); //1.创建索引,索引就是数据库中的数据库概念
            
            $r = $this->create_mappings('product','product_ik'); //2.创建文档模板，这个就是数据库中的表的概念
        }
        $datas=$this->getAll();
        foreach ($datas as $k => $v) {
            $r = $this->add_doc($k,$v,'product_ik','product');   //3.添加文档
        }
        $r = $this->search_doc($keyword,'product_ik','product');  //4.搜索结果
        $dato=$r['hits']['hits'];
        $data=array();
        foreach ($dato as $key => $value) {
            $data[$key]['name']=$value['_source']['name'];
            $data[$key]['names']=$value['highlight']['name'];
            $data[$key]['main_images']=$value['_source']['main_images'];
            $data[$key]['sell_price']=bcdiv($value['_source']['sell_price'], 100,2);
            $data[$key]['opening_price']=bcdiv($value['_source']['opening_price'], 100,2);
            $data[$key]['sku_id']=$value['_source']['id'];
            $data[$key]['product_id']=$value['_source']['product_id'];
        }
        // var_dump($data);exit;
        if(empty($data)){
            $msg['code']=false;
            $msg['mes']='暂无商品';
        }else{
            $msg['code']=true;
            $msg['mes']=$data;
        }
        $this->ajaxReturn($msg);
    }

    /**
     * @ 创建索引
     * @param index_name  索引名 类似数据库名 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function create_index($index_name = 'test_ik') { // 只能创建一次
        $params = [
            'index' => $index_name,
            'client' => [ 'ignore' => [400, 404] ],
            'body' => [
                'settings' => [
                    'number_of_shards' =>1,
                    'number_of_replicas' => 0
                ]
 
            ],
 
        ];
        // return $this->client->indices()->create($params);
        try {
            $msg['msg']=$this->client->indices()->create($params);
            $msg['code']=1;
            return $msg;
        } catch (Elasticsearch\Common\Exceptions\BadRequest400Exception $e) {
            $msg['msg'] = $e->getMessage();
            $msg['code']=1;
            return $msg;
        } 
    }
    /**
     * @ 删除索引
     * @param index_name  索引名 类似数据库名 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function delete_index($index_name = 'test_ik') {
        $params = ['index' => $index_name];
        $response = $this->client->indices()->delete($params);
        return $response;
    }
     /**
     * @ 判断索引是否存在
     * @param index_name  索引名 类似数据库名 
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function exists_index($index_name = 'test_ik'){
        $params = [
            'index' =>$index_name
        ];
        $response =$this->client->indices()->exists($params);
        return $response;
    }
    /**
     * @ 创建文档模板
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
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
                        "fielddata"=> true,
                    ],
                    'name' => [
                        'type' => 'text', // 字符串型
                        'index' => 'true', // 全文搜索
                        'analyzer' => 'ik_max_word'
                    ],
                    'main_images' => [
                        'type' => 'text',
                        'index' => 'false', // 全文搜索
                    ],
                    'sell_price' => [
                        'type' => 'integer',
                        'index' => 'false', //非 全文搜索
                    ],
                    'opening_price' => [
                        'type' => 'integer',
                        'index' => 'false', //非 全文搜索
                    ],
                    'product_id' => [
                        'type' => 'integer',
                        'index' => 'false', //非 全文搜索
                    ],
                ]
 
            ]
 
        ];
 
        $response = $this->client->indices()->putMapping($params);
        return $response;
    }
 
    /**
     * @ 查看映射，就是相当于数据库的数据结构
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function get_mapping($type_name = 'users',$index_name = 'test_ik') {
        $params = [
            'index' => $index_name,
            'type' => $type_name
        ];
        $response = $this->client->indices()->getMapping($params);
        return $response;
    }
  
    /**
     * @ 添加文档
     * @param id  索引id 
     * @param doc  数据 
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
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
 
    /**
     * @ 判断文档存在
     * @param id  索引id 
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function exists_doc($id =1,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id
        ];
 
        $response = $this->client->exists($params);
        var_dump($response);exit;
        return $response;
    }

 
    /**
     * @ 获取文档
     * @param id  索引id 
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function get_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id
        ];
 
        $response = $this->client->get($params);
        return $response;
    }
 
    /**
     * @ 更新文档
     * @param id  索引id 
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function update_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        // 可以灵活添加新字段,最好不要乱添加
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id,
            'body' => [
                'doc' => [
                    'name' => '大王'
                ]
            ]
        ];
 
        $response = $this->client->update($params);
        return $response;
    }
  
    /**
     * @ 删除文档
     * @param id  索引id 
     * @param index_name  索引名 类似数据库名 
     * @param type_name   逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function delete_doc($id = 1,$index_name = 'test_ik',$type_name = 'users') {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'id' => $id
        ];
 
        $response = $this->client->delete($params);
        return $response;
    }
 
    /**
     * @ 查询文档 (分页，排序，权重，过滤)
     * @param keywords 关键字   
     * @param index_name  索引名 类似数据库名
     * @param type_name 逻辑分组 类似表名
     * @return json 
     * @todo   Some defects
     * @author jachin 2020-8-19
     **/
    public function search_doc($keywords = "删库",$index_name = "test_ik",$type_name = "users") {
        $params = [
            'index' => $index_name,
            'type' => $type_name,
            'body' => [
                'query' => [
                    'bool' => [//bool查询，可以把很多小的查询组成一个更为复杂的查询，
                        'should' => [// 这里should是查询profile字段包含$keywords关键词或者name字段包含$keywords关键词的文档。可以改为"must"意思是同时包含。must_not排除包含
                            [ 'match' => [ 'name' => [
                                'query' => $keywords,
                                'boost' => 2,
                            ]]],
                        ],
                    ],
                ],
                'highlight' => [
                    'pre_tags'  => ["<em>"],
                    'post_tags' => ["</em>"],
                    'fields'    => [
                        "name"  => new \stdClass(),
                    ]
                ],
                // 'sort' => ['id'=>['order'=>'desc']],
                
            ]
        ];
        $results = $this->client->search($params);
        return $results;
    }

}