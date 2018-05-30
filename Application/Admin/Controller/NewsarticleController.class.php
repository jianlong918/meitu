<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/14
 * Time: 9:49
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Page;

class NewsarticleController extends BaseController{
    protected $table='NArticle';
    protected $sign=',';
    public function index(){
        $title=I('get.title');
        $condition['is_del']=0;
        if(!empty($title)){
            $condition['title']=array('like','%'.$title.'%');
        }
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='sortrank desc,weight asc',$limit=15,$field='');
        $this->assign(array(
           'data'=>$data,
           'title'=>$title,
        ));
        $this->display();
    }
    /*回收站列表*/
    public function recycle(){
        $title=I('get.title');
        $condition['is_del']=1;
        if(!empty($title)){
            $condition['title']=array('like','%'.$title.'%');
        }
        /*分页*/
        $data=$this->getPage(M($this->table),$condition,$order='sortrank desc,weight asc',$limit=15,$field='');
        $this->assign(array(
            'data'=>$data,
            'title'=>$title,
        ));
        $this->display();

    }
    /*添加视图*/
    public function add(){
           $flag=C('flag');
           $sortup=C('sortup');
           $types=$this->getAll('n_type', '',$field='id,typename,pid');
           $type_id=I('get.type_id',0,'int')?I('get.type_id',0,'int'):'';
           $type_list=LimitlessListTypes($types,0,$deep=1,$type_id);
           $this->assign(array(
                'flag'=>$flag,
                'type_list'=>$type_list,
                'sortup'=>$sortup,
            ));
            $this->display();
        }

    /*保存*/
    public function save(){
        import('Vendor.Keywords.Splitword');
        $description_max=C('description_max');
        $content=I('post.content');
        if(empty($content)){
            $this->error('文章内容不能为空！');
        }
        /*描述字数限制：配置文件。文章描述处理，如没有填写描述，截取内容*/
        $description=I('post.description');
        if(empty($description)){
            $description = cn_substr(html2text($_POST['content']),$description_max);
            $description = trim(preg_replace('/#p#|#e#/','',$description));
            $_POST['description'] = addslashes($description);
        }else{
            $_POST['description']=cn_substr($description,$description_max);
        }
        /*自定义属性*/
        $flag=I('post.flag');
        if(!empty($flag)){
            $_POST['flag']=implode(',',$flag);
        }
        /*点击数，范围在配置文件定义*/
        $click=I('post.click');
        if(empty($click)){
            $click_default=C('click_default');
            $_POST['click']=mt_rand($click_default[1], $click_default[2]);
        }
        $_POST['created_at']=date("Y-m-d H:i:s",time());
        $updated_at=I('post.updated_at');
        if($updated_at==0){
            $_POST['updated_at']=date("Y-m-d H:i:s",time());
        }
        /*置顶时间*/
        $sortup=I('post.sortup');
        $_POST['sortrank']=AddDay(strtotime($_POST['updated_at']),$sortup);
        $writer=I('post.writer');
        if(empty($writer)){
            $userinfo=session('uinfo');
            $_POST['writer']=$userinfo['username'];
        }
        /*缩略图，没有缩略图，从文章内容获取*/
        $litpic=I('post.litpic');
        if(empty($litpic)){
            $_POST['litpic']=$this->_thumb($_POST['content']);
        }
        $images=I('post.img');
        if(!empty($images)){
            $_POST['images']=implode(',',$images);
        }
        $typeOb=D($this->table);
        if($typeOb
            ->field('title,shorttitle,flag,litpic,images,writer,typeid,keywords,description,notpost,click,weight,sortup,sortrank,created_at,updated_at')
            ->create($_POST)){
            $re=$typeOb->add();
            if($re){
                /*n_addonarticle表存入文章内容*/
                $data['aid']=$re;
                $data['typeid']=$_POST['typeid'];
                $data['body']=$_POST['content'];
                $re_addon=M('n_addonarticle')->add($data);
                if(!$re_addon){
                    $this->error('添加文章内容失败！');
                }
                /*tags*/
                $tags=I('post.tags');
                if(!empty($tags)){
                    $tags=explode($this->sign,$tags);
                    $this->_insert_tags($tags,$re,$_POST['typeid']);
                }
                $this->success("添加成功","/admin/newsarticle/index");
            }else{
                $this->error("添加失败");
            }

        }else{
            $dealer=$typeOb->getError();//获取自动验证的错误提示
            $this->error($dealer);
        }
  }


    /*文章编辑*/
     public function update(){
         $id=I('get.id',0,'int');
         if(empty($id)){
             die('数据错误！');
         }
         $article=$this->getSinglebyId($id,$field='');
         /*图片集*/
         if(!empty($article['images'])){
             $article['img_arr']=explode(',',$article['images']);
         }
         $article['body']=M('n_addonarticle')->where(array('aid'=>$id))->getField('body');
         $tags=M('n_taglist')->where(array('aid'=>$id))->getField('tid,tag');
         $article['tags']=implode(',',$tags);
         $flag=C('flag');
         $sortup=C('sortup');
         $types=$this->getAll('n_type', '',$field='id,typename,pid');
         $type_list=LimitlessListTypes($types,0,$deep=1,$article['typeid']);
         $this->assign(array(
             'article'=>$article,
             'flag'=>$flag,
             'type_list'=>$type_list,
             'sortup'=>$sortup,
         ));
         $this->display();

    }

    /*文章编辑保存*/
    public function usave(){
        $id=I('post.id');
        $content=I('post.content');
        if(empty($content)){
            $this->error('文章内容不能为空！');
        }
        $tags=I('post.tags');
        $typeid=I('post.typeid');
        if(!empty($tags)){
            /*tags标签修改前后比较,修改时新增标签添加，去除标签删除*/
            $tags_initial_arr=M('n_taglist')->where(array('aid'=>$id))->getField('tid,tag');
            $tags_post_arr=explode($this->sign,$tags);
            $tags_diff=array_diff($tags_post_arr,$tags_initial_arr);
            if(!empty($tags_diff)){
                foreach($tags_post_arr as $tag_post){
                    $tag_post = trim($tag_post);
                    if(isset($tag_post[12]) || $tag_post!=stripslashes($tag_post)){
                        continue;
                    }
                    if(!in_array($tag_post,$tags_initial_arr)){
                        $this->_InsertOneTag($tag_post,$id,$typeid);
                    }
                }

                foreach($tags_initial_arr as $tag_init){
                    if(!in_array($tag_init,$tags_post_arr)){
                        M('n_taglist')->where(array('aid'=>$id,'tag'=>$tag_init))->delete();
                        $total=M('n_tagindex')->where(array('tag'=>$tag_init))->getField('total');
                        if($total>1){
                            M('n_tagindex')->where(array('tag'=>$tag_init))->setDec('total');
                        }else{
                            M('n_tagindex')->where(array('tag'=>$tag_init))->delete();
                        }
                    }else{
                        M('n_taglist')->where(array('aid'=>$id,'tag'=>$tag_init))->save(array('type_id'=>$typeid));
                    }
                }
            }
        }
        $description=I('post.description');
        if(empty($description)){
            $description = cn_substr(html2text($_POST['content']),C('description_max'));
            $description = trim(preg_replace('/#p#|#e#/','',$description));
            $_POST['description'] = addslashes($description);
        }
        $flag=I('post.flag');
        if(!empty($flag)){
            $_POST['flag']=implode(',',$flag);
        }
        $click=I('post.click');
        if(empty($click)){
            $click_default=C('click_default');
            $_POST['click']=mt_rand($click_default[1], $click_default[2]);
        }
        $updated_at=I('post.updated_at');
        if($updated_at==0){
            $_POST['updated_at']=date("Y-m-d H:i:s",time());
        }
        $sortup=I('post.sortup');
        $_POST['sortrank']=AddDay(strtotime($_POST['updated_at']),$sortup);
        $writer=I('post.writer');
        if(empty($writer)){
            $userinfo=session('uinfo');
            $_POST['writer']=$userinfo['username'];
        }
        $litpic=I('post.litpic');
        if(empty($litpic)){
            $_POST['litpic']=$this->_thumb($_POST['content']);
        }
        $images=I('post.img');
        $_POST['images']=implode(',',$images);
        $typeOb=D($this->table);
        if($typeOb
            ->field('title,shorttitle,flag,litpic,writer,typeid,keywords,description,notpost,click,weight,sortup,updated_at')
            ->create($_POST)){
            $re=$typeOb->save($_POST);
            if($re!==FALSE){
                $data['aid']=$id;
                $data['typeid']=$_POST['typeid'];
                $data['body']=$_POST['content'];
                $re_addon=M('n_addonarticle')->save($data);
                if($re_addon===FALSE){
                    $this->error('编辑文章内容失败！');
                }
                $this->success("编辑成功","/admin/newsarticle/index");
            }else{
                $this->error("编辑失败");
            }

        }else{
            $dealer=$typeOb->getError();//获取自动验证的错误提示
            $this->error($dealer);
        }
    }


    /*文章删除，删除进入回收站*/
    public function del(){
        $id=I('post.id',0,'int');
        if(empty($id)){
            $this->error('数据错误！');
        }
        $re=D($this->table)->editData(array('id'=>$id),array('is_del'=>1));
        if(!$re){
            $this->error('删除失败！');
        }else{
            $this->success('删除成功！');
        }

    }

    /*回收站文章回复 单个*/
    public function recover(){
        $id=I('post.id',0,'int');
        if(empty($id)){
            $this->error('数据错误！');
        }
        $re=D($this->table)->editData(array('id'=>$id),array('is_del'=>0));
        if(!$re){
            $this->error('恢复失败！');
        }else{
            $this->success('恢复成功！');
        }

    }

    /*回收站文章彻底删除 单个*/
    public function clear(){
        $id=I('post.id',0,'int');
        if(!empty($id)){
            $re=D($this->table)->deleteData(array('id'=>$id));
            if(!$re){
                $this->error('删除失败！');
            }
            $re_addon=D('NAddonarticle')->deleteData(array('aid'=>$id));
            if(!$re_addon){
                $this->error('删除文章内容失败！');
            }
            $this->success('删除成功！');
        }
    }

    /*回收站文章彻底删除 批量*/
    public function clear_many(){
        $ids=I('post.ids');
        if(empty($ids)){
            $this->error('请选择客户！');
        }
        $condition['id']=array('in',$ids);
        $re=D($this->table)->deleteData($condition);
        if(!$re){
            $this->error('删除失败！');
        }
        $condition_addon['aid']=array('in',$ids);
        $re_addon=D('NAddonarticle')->deleteData($condition_addon);
        if(!$re_addon){
            $this->error('删除文章内容失败！');
        }
        $this->success('删除成功！');
    }

    /*文章删除，恢复，批量 is_del 1删除 0回收*/
    public function del_many(){
        $ids=I('post.ids');
        $status=I('post.status');
        if(empty($ids)){
            $this->error('请选择客户！');
        }
        $condition['id']=array('in',$ids);
        $data['is_del']=$status;
        $re=D($this->table)->editData($condition,$data);
        if($re){
            $this->success('操作成功');
        }else{
            $this->error('操作失败！');
        }

    }

    public function del_img(){
        $path=I('post.path');
        $id=I('post.id');
        $product=$this->getSinglebyId($id,'images');
        $img_arr=explode(',',$product['images']);
        $img=array($path);
        $img_new=array_diff($img_arr,$img);
        $data['images']=implode(',',$img_new);
        $re=$this->UpdateSinglebyId($id,$data);
        if($re){
            $this->success('删除成功！');
        }else{
            $this->error('删除失败！');
        }
    }

    /** 将文章第一个图片作为缩略图
     * @param $content 文章内容
     * @return string 图片url
     */
    private function _thumb($content){
        $content = stripslashes($content);
        if(preg_match_all("/(src)=([\"|']?)([^ \"'>]+\.(gif|jpg|jpeg|bmp|png))\\2/i", $content, $matches)) {
            $str = $matches[3][0];
            if (preg_match('/Uploads/', $str)) {
                return $str;
            }
        }
        return '';
    }

    /** tag标签插入tag表
     * @param $tag_str 用，连接的tag字符串
     * @param $aid 文章id
     */
    private function _insert_tags($tags,$aid,$typeid){
        foreach($tags as $tag){
            $tag = trim($tag);
            if(isset($tag[20]) || $tag!=stripslashes($tag)){
                continue;
            }
            $this->_InsertOneTag($tag,$aid,$typeid);
        }

    }

     private function _InsertOneTag($tag,$aid,$typeid){
        $tag=trim($tag);
        if($tag==''){
            return '';
        }
        $data['tag']=$tag;
        if(empty($typeid)){
            $data['typeid']=0;
        }else{
            $data['typeid']=$typeid;
        }
        $rs=FALSE;
        $data['created_at']=date("Y-m-d H:i:s",time());
        $row=M('n_tagindex')->where(array('tag'=>$tag))->find();
        if(!is_array($row)){
            $data['total']=1;
            $rs=M('n_tagindex')->add($data);
            $data['tid']=$rs;
        }else{
            $rs=M('n_tagindex')->where(array('tag'=>$tag))->save(array('total'=>$row['total']+1));
            $data['tid']=$row['id'];
        }
        if($rs){
            $data['aid']=$aid;
            $res=M('n_taglist')->add($data);
            if(!$res){
                return FALSE;
            }
        }
    }

}
