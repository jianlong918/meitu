<?php
namespace Home\Controller;
use Think\Controller;
use Think\Page;

class NewsController extends BaseController{
    protected $table='NArticle';

    //文章详情页
    public function view(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据错误！');
        }
        $article=$this->getSinglebyId($id);
        /*图片集*/
        if(!empty($article['images'])){
            $article['img_arr']=explode(',',$article['images']);
        }
        $article['body']=M('n_addonarticle')->where(array('aid'=>$id))->getField('body');
        //还喜欢
        $articles_rand = M($this->table)->where(array('typeid'=>$article['typeid']))->order('rand()')->limit(8)->getField('id,title,typeid,litpic,click,created_at');
        $avalible = 0;//是否有会员权限
        if(session("uinfo")){
            $minfo = session("uinfo");
            $minfo = $this->getSinglebyId($minfo['id'],"expire_at","s_member");
            $expire_at = $minfo['expire_at'];
            $d1 = strtotime($expire_at);
            $d2 = time();

            if($d1>=$d2){
                $avalible = 1;//是否有会员权限
            }
        }

        $this->assign(array(
            "avalible"=>$avalible,
            'article'=>$article,
            'articles_rand'=>$articles_rand
        ));

        $ntype = $this->getSinglebyId($article['typeid'],'','n_type');
        $tpl = $ntype['tplarticle']?$ntype['tplarticle']:"article_article";

        $this->display($tpl);
    }

    //频道封面栏目
    public function alist(){
        $id=I('get.id',0,'int');
        if(empty($id)){
            die('数据错误！');
        }
        $atype=$this->getSinglebyId($id,'','n_type');
        $this->assign('atype',$atype);// 赋值分页输出

        if($atype['is_part']==0){
            $m_art = M("n_article");
            $count      = $m_art->where(array("typeid"=>$id))->count();// 查询满足要求的总记录数
            $Page       = new \Think\Page($count,27);// 实例化分页类 传入总记录数和每页显示的记录数(25)
            $show       = $Page->show();// 分页显示输出

            // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
            $list = $m_art->where(array("typeid"=>$id))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
            $this->assign('list',$list);// 赋值数据集
            $this->assign('page',$show);// 赋值分页输出
            $tpl = empty($atype['tplindex'])?"article_list":$atype['tplindex'];
        }else{
            $tpl = empty($atype['tplindex'])?"article_index":$atype['tplindex'];
        }

        $this->display($tpl);

    }




}
