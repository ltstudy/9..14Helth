<?php
namespace app\admins\controller;
//namespace Ali;
use think\Controller;
use think\Db;
use think\Request;
use think\Query;
use think\View;
use test\Page;
use think\paginator;
class Chain extends Controller{
    public function index(){
        $data = db('health_chain')->paginate(10);
        return view('chain',['data'=>$data]);
    }
    public function search(){
        $data = input();
        $page = isset($data['page']) ? $data['page'] : 1;
        $page_size = 2;
        $total = db('health_chain')->count();
        $total_page = ceil($total/$page_size);
//        return $total_page;
        $offset = ($page-1)*$page_size+1;
//        echo $limit;die;
        if(array_key_exists('page',$data)){
            unset($data['page']);
        }
            $where=$this->getWhere($data);
            if($where){
                $adc['chain_time'] = [$where['chain_time'][0],$where['chain_time'][1]];
//     dump($adc);die;
                $mvp['chain_status'] = [$where['chain_status'][0],$where['chain_status'][1]];
                $result['data'] = DB::table('health_chain')->where($adc)->where($mvp)->page($page)->limit($page_size)->select();
//     dump($result);die;
                if(!empty($result)){
                    $params = array(
                        'total_rows'=>$total,
                        'method'=>'ajax',
                        'now_page'=>$page,
                        'ajax_func_name'=>'page',
                        'list_rows'=>$page_size,
                        'parameter'=>http_build_query($data),
                    );
                    $pags = new \test\Page($params);
//            var_dump($pags);die;
                    $result['page']=$pags->show(3);
//            dump($result);die;
                    $result['status']=1;
                }else{
                    $result['status']=0;
                }
                return $result;
            }

    }
    /**进行搜索封装**/
    public function getWhere($where){
        $arr = array();
        switch (intval($where['chain_status'])){
            case 0:
            $arr['chain_status'] = array('eq',0);
            break;
            case 1:
            $arr['chain_status'] = array('eq',1);
            break;
            case 2:
            $arr['chain_status'] = array('neq',3);
            break;
            default:
        }
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
        $beginThismonth = mktime(0,0,0,date('m')-2+1,1,date('Y'));
        $endThismonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
        $Threemonth = mktime(0,0,0,date('m')-3+1,1,date('Y'));
        $Tendmonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
        $Alltime =  mktime(0,0,0,date('m')-3+1,1,date('Y')-10);
        switch(intval($where['chain_time'])){
             case 0:
            //当天的时间
             $arr['chain_time'] = ['between',[$beginToday,$endToday]];
             break;
             case 1:
            //当前一周的时间
             $arr['chain_time'] = ['between',[$beginLastweek,$endLastweek]];
             break;
             case 2:
             //当前一个月的时间
              $arr['chain_time'] = ['between',[$beginThismonth,$endThismonth]];
              break;
              case 3:
              //当前三个月的的时间 （算上当前的月份）
              $arr['chain_time'] = ['between',[$Threemonth,$Tendmonth]];
              break;
              case 4:
               $arr['chain_time'] = ['between',[$Alltime,$endToday]];
              default:
        }
        return $arr;
    }
    protected function time(){
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;
        $beginLastweek=mktime(0,0,0,date('m'),date('d')-date('w')+1-7,date('Y'));
        $endLastweek=mktime(23,59,59,date('m'),date('d')-date('w')+7-7,date('Y'));
        $beginThismonth = mktime(0,0,0,date('m')-2+1,1,date('Y'));
        $endThismonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
        $Threemonth = mktime(0,0,0,date('m')-3+1,1,date('Y'));
        $Tendmonth = mktime(23,59,59,date('m'),date('t'),date('Y'));
        $Alltime =  mktime(0,0,0,date('m')-3+1,1,date('Y')-10);
        $map['chain_status']=1;
//        $map['chain_status']=2;
//
//// and 关系
////        $map['chain_time']=array('egt',1505192742);
////        $map['chain_time']=array('elt',1502514441);->where('chain_status',['eq',0],['eq',1],'or')
//        $map1['chain_status']=array('eq',1);
//        $map2['chain_time']=array('between','1183219200,1905145600');
//        $list = Db::name('health_chain')->where($map2)->where($map1)->select();
////dump($list);die;
    }
}