<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DashBoard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        header("content-type:text/html;charset=utf-8");
        $this->load->database();
        $this->load->model("dashboard_model");
        $this->load->model("captcha_model");
    }

    public function islogined() {
        $this->load->helper("url");
        $this->load->library('session');
        $acc_id = $this->session->userdata('acc_id');
        $acc_status = $this->session->userdata('status'); 
            
        if( $acc_id <= 0) {
            header("Location:".base_url()."index.php/dashboard/login"); 
            return;
        }else{
            if($acc_status == 0) {
                header("content-type:text/html;charset=utf-8");
              //  header("Location:".base_url()."index.php/dashboard/settings"); 
                echo "<script>alert('账户未激活前，无法使用其他功能');location.href='".base_url()."index.php/dashboard/settings';</script>";
            }
            return $acc_id;
        }
    } 

    public function logout() {
        $this->load->helper("url");
        $this->load->library('session');
        $userdata = array('acc_id'=>"",'accemail'=>"", 'email'=>'');
        $this->session->unset_userdata($userdata); 
        header("Location:".base_url());
//        header("Location:".base_url()."index.php/dashboard/login"); 
    }

    public function login() {
        $this->load->helper("url");
        $this->load->helper("form");

        $data['cap'] = $this->captcha_model->getCaptcha();
        $this->load->view('login', $data);
    }

    public function newcaptcha() {
        $this->load->helper("url");
        echo $this->captcha_model->newCaptcha();
    }


    public function isUserExist() { // For Ajax 
        $accemail = $this->input->post('email');
        if($this->dashboard_model->isUserExist($accemail) == false) {
            echo "0"; 
        }else {
            echo "1"; 
        } 
    }


    public function usercheck() {
        $this->load->library('session');
        $this->load->helper("url");
        $accemail = $this->input->post('email'); 
        $password = $this->input->post('password'); 
        $captcha = strtolower($this->input->post("captcha"));

        if ( $this->captcha_model->checkCaptcha($captcha) == false ) {
            //echo "<script>alert('验证码错误');location.href=\"".base_url()."index.php/dashboard/login\"</script>";
            echo "<meta charset='utf-8'>";
            echo "<script>alert('验证码错误');history.back()</script>";
        }else{
            $accinfo = $this->dashboard_model->userValidate($accemail, $password);
            if(!empty($accinfo)) {
            //if( $acc_id  > 0 ) {
                $acc_id = $accinfo['acc_id'];
                $info = array(
                    "accemail" => $accemail,
                    "acc_id" => $acc_id,
                    "password" => md5($password),
                    "status" => $accinfo['status'],
                );
                $this->session->set_userdata($info);
                $this->dashboard_model->userlogin($acc_id);
                //echo base_url();
                header("Location:".base_url()); 
            }else {
                //header("Location:".base_url()."index.php/dashboard/login"); 
                echo "<meta charset='utf-8'>";
                echo "<script>alert('用户名或密码错误');history.back()</script>";
                //echo base_url()."index.php/dashboard/login";
            };
        }
    }

    public function index()
    {
        $this->load->helper("url");
        $data['navbar'] = "1";
        $data['acc_id'] = $this->islogined();
        $data['accemail'] = $this->session->userdata("accemail");

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/footer');
    }

    public function settings() {
        $this->load->helper("url");
        $this->load->helper("form");
        $data['navbar'] = "5";
//        $data['acc_id'] = $this->islogined();
        $this->load->library('session');
        $data['acc_id'] = $this->session->userdata('acc_id');
        $data['accemail'] = $this->session->userdata("accemail");
        $data['settings'] = $this->dashboard_model->get_settings($data['acc_id']);
        $data['userinfo'] = $this->dashboard_model->userinfo($data['acc_id']);

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/settings');
        $this->load->view('admin/footer');
    }

    public function settings_save() {
        $acc_id = $this->islogined();
        $this->load->helper("url");
        $settings['accname'] = $this->input->post('accname');
        $settings['company'] = $this->input->post('company');
        $settings['url'] = $this->input->post('url');
        $settings['flow'] = $this->input->post('flow');
        $settings['adminlist'] = $this->input->post('adminlist');
        $this->dashboard_model->update_settings($acc_id, $settings);

        header("Location:".base_url()."index.php/dashboard/settings");
    }

    public function update_pwd() {
        $this->load->helper("url");
        $acc_id = $this->islogined();
        $pwd = md5($this->input->post("pwd"));
        $newpwd = $this->input->post("newpwd");
        $repwd = $this->input->post("repwd");
        if($pwd != $this->session->userdata("password")) {
            echo "-1"; // 原始密码错误 
        }else {
            if($newpwd != $repwd) {
                echo "-2";// 两次新密码不匹配
            }else {
                if($this->dashboard_model->update_pwd($acc_id, md5($newpwd))) {
                    $this->session->set_userdata("password", md5($newpwd)); 
                    echo "1"; //更新成功
                }
                else
                    echo "0"; //没有变化
            }
        }
    }

    public function active_email($acc_id) {
        $this->load->helper("url");
        $userinfo = $this->dashboard_model->userinfo($acc_id);
        $to = $userinfo['accemail'];
        $config['protocol']     = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.exmail.qq.com';
        $config['smtp_user']    = 'ad@adhouyi.com';
        $config['smtp_pass']    = 'ad123456';
        $config['smtp_port']    = '465';
        $config['charset']      = 'utf-8';
        $config['mailtype']     = 'html';
        $config['smtp_timeout'] = '5';
        $config['newline'] = "\r\n";
        $this->load->library ('email', $config);
        $this->email->from ('ad@adhouyi.com', '宏聚时代');
        $this->email->to ($to, 'AAA');
        $this->email->subject ('账号激活通知');
        $url = base_url()."index.php/dashboard/activeuser/{$acc_id}/".md5($to)."/";
        $content = "你好<br> 感谢您注册我们的服务，请点击下面的连接激活您的账号<br> <a href='{$url}'>{$url}</a><br>".date("Y-m-d");
        $this->email->message ($content);
        $this->email->send (); 

        //echo $this->email->print_debugger();
    }

    public function activeuser($acc_id, $email_md5) {
        $this->load->helper("url");
        $this->load->library('session');
        echo "<meta charset='utf-8'>";
        if($this->dashboard_model->activeuser($acc_id, $email_md5)) {
        //active success
            $this->session->set_userdata('status',1);
            echo "<script>alert(\"账号激活成功\");location.href='".base_url()."index.php/dashboard/login'</script>"; 
        }else {
        //active failed
            echo "<script>alert(\"账号激活失败\");</script>"; 
        };  
    }

    public function navibar() {
        $this->load->helper("url");
        $this->load->helper("form");
        $data['navbar'] = "1";
        $data['acc_id'] = $this->islogined();
        $data['accemail'] = $this->session->userdata("accemail");

        $this->load->model("category_model");
        $page['category'] = $this->category_model->getAll();
        $this->load->model("pagenavi_model");
        $page['navibars'] = $this->pagenavi_model->getAll();

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/page_navi', $page);
        $this->load->view('admin/footer');
    }

    public function navibar_add() {
        $this->islogined();
        $this->load->helper("url");
        $this->load->model("pagenavi_model");

        $data['name'] = $this->input->post('navi_name');
        $data['type'] = $this->input->post('type');
        if($data['type'] == 'fixedurl') {
            $data['url'] = $this->input->post('fixedurl');
        }else if($data['type'] == 'category') {
            $data['category'] = $this->input->post('category');
        }
        echo json_encode($this->pagenavi_model->add($data));
    }

    public function navibar_del() {
        $this->islogined();
        $this->load->model("pagenavi_model");
        $navi_id = $this->input->post('id');
        if($this->pagenavi_model->delete($navi_id)) {
            echo json_encode(array('ret'=>0));
        }else{
            echo json_encode(array('ret'=>$navi_id));
        }
    }

    public function navibar_detail() {
        $this->islogined();
        $this->load->model("pagenavi_model");
        $navi_id = $this->input->post('id');

        echo json_encode($this->pagenavi_model->get($navi_id));
    }

    public function navibar_update() {
        $this->islogined();
        $this->load->model("pagenavi_model");

        $data['id'] = $this->input->post('navi_id');
        $data['type'] = $this->input->post('type');
        $data['name'] = $this->input->post('navi_name');

        if($data['type'] == 'fixedurl') {
            $data['url'] = $this->input->post('fixedurl');
        }else if($data['type'] == 'category') {
            $data['category'] = $this->input->post('category');
        }
        $ret = $this->pagenavi_model->update($data);
        //var_dump($ret);
        echo json_encode($ret);
    }

    public function slides() {
        $this->load->helper("url");
        $this->load->helper("form");
        $data['navbar'] = "2";
        $data['acc_id'] = $this->islogined();
        $data['accemail'] = $this->session->userdata("accemail");

        $this->load->model("slide_model");
        $slides['slides'] = $this->slide_model->getAll();

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/slides',$slides);
        $this->load->view('admin/footer');
    }

    public function slide_upload() {
        $this->islogined();
        
        $config['upload_path'] = "./uploads/slides/";
        $config['allowed_types'] = "jpg|png|bmp";
        $config['max_size'] = "2048";
        //$config['max_width'] = "1920";
        //$config['max_height'] = "1280";

        $this->load->library('upload', $config);
	    if ( ! $this->upload->do_upload()) {
			$data['error'] = $this->upload->display_errors();
            echo "<script>alert('图片添加失败:{$data['error']}')</script>"; 
		} else {
			$data = array('upload_data' => $this->upload->data());
            $this->load->library('image_lib');

            $slide['path'] = "/uploads/slides/".$data['upload_data']['raw_name'].$data['upload_data']['file_ext'];
            $slide['thumbnail'] = "/uploads/slides/".$data['upload_data']['raw_name']."_thumb".$data['upload_data']['file_ext'];
            //$slide['timestamp'] = time();
            $slide['text'] = $this->input->post('description');
            $slide['url'] = $this->input->post('url');
            $slide['status'] = $this->input->post('status');

            $img_config['image_library'] = "gd2";
            $img_config['source_image'] = $data['upload_data']['full_path'];
            $img_config['create_thumb'] = TRUE;
            $img_config['maintain_ratio'] = TRUE;
            $img_config['width'] = 140;
            $img_config['height'] = 80;

            $this->load->library('image_lib', $img_config); 
            $this->image_lib->initialize($img_config);
            if($resize = $this->image_lib->resize()) {
                $data['error'] = $this->image_lib->display_errors();
                $this->load->model("slide_model");

                if($this->slide_model->add($slide)) {
                    //echo $this->db->last_query();
                    redirect('/dashboard/slides','refresh');
                }else{
                    echo "<script>alert('缩略图创建失败:{$data['error']}')</script>"; 
                    redirect('/dashboard/slides','refresh');
                    return;
                }
            }
		}

        redirect('/dashboard/slides','refresh');
    }

    public function slide_del() {
        $this->islogined();

        $slide_id = $this->input->post('id');
        $this->load->model("slide_model");

        if($this->slide_model->del($slide_id)) {
            $data['ret'] = 0; //删除成功
        }else{
            $data['ret'] = 1; //删除失败
        }
        echo json_encode($data);
    }

    public function category() {
        $this->load->helper("url");
        $this->load->helper("form");
        $this->load->model("category_model");
        $data['navbar'] = "3";
        $data['acc_id'] = $this->islogined();
        $data['accemail'] = $this->session->userdata("accemail");

        $category['category'] = $this->category_model->getAll();
        $category['rows_count'] = count($category['category']);

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/category',$category);
        $this->load->view('admin/footer');
    }

    public function category_add() {
        $this->islogined();

        $category = $this->input->post('category');
        $data = array('category'=>$category);
        if($this->db->insert('category', $data)) {
            $data['id'] = $this->db->insert_id();
        }else{
            $data['id'] = 0;
        }
        echo json_encode($data);
    }

    public function category_del() {
        $this->islogined();
        $this->load->model("category_model");
        $category_id = $this->input->post('id');
        if($this->category_model->delete($category_id)) {
            echo json_encode(array('ret'=>0));
        }else{
            echo json_encode(array('ret'=>$category_id));
        }
    }

    public function category_update() {
        $this->islogined();
        $this->load->model("category_model");
        $category_id = $this->input->post('category_id');
        $category_name = $this->input->post('category_name');
        if($this->category_model->update($category_id, $category_name)) {
            $data = array('id'=>$category_id, 'category'=> $category_name);
        }else{
            $data = array('id'=>0);
        }
        echo json_encode($data);
    }

    public function articles() {
        $this->load->helper("url");
        $this->load->library("pagination");
        $data['navbar'] = "4";
        $data['acc_id'] = $this->islogined();
        $data['accemail'] = $this->session->userdata("accemail");
        
        $config['base_url'] = site_url('books/index');
        $config['total_rows'] = $this->db->count_all('articles');
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['full_tag_open'] = '<p>';
        $config['full_tag_cloase'] = '</p>';

        $this->pagination->initialize($config);

        $this->load->model("article_model");
        $articles['articles'] = $this->article_model->get_articles($config['per_page'], $this->uri->segment(3));

        $this->load->library('table');
        $tmpl = array(
            'table_open'    => "<table class='table table-striped table-hover'>",
            'row_alt_start'       => '<tr>',
            'row_alt_end'         => "<td><button class='btn btn-sm btn-warning' id='btn_edit'>编辑</button> <button class='btn btn-sm btn-danger' id='btn_del'>删除</button> </td></tr>",
            'table_close'   => '</table>'
        );
        $this->table->set_template($tmpl);
        $this->table->set_heading('序号', '文章标题', '类别', '操作');

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/article_list', $articles);
        $this->load->view('admin/footer');
    }

    public function article_add() {
        $this->load->helper("url");
        $this->load->helper("form");
        $data['navbar'] = "4";
        $data['acc_id'] = $this->islogined();
        $data['accemail'] = $this->session->userdata("accemail");

        $this->load->model("category_model");
        $page['category'] = $this->category_model->getAll();
        $page['id'] = 0;

        $this->load->view('admin/header');
        $this->load->view('admin/navbar',$data);
        $this->load->view('admin/article', $page);
        $this->load->view('admin/footer');
    }

    public function article_save() {
        $this->islogined();
        $this->load->model("article_model");

        $data['title'] = $this->input->post('title');
        $data['source'] = $this->input->post('source');
        if(empty($data['source'])) {
            $data['source'] = "本站发布";
        }
        $data['category'] = $this->input->post('category');
        $data['content'] = $this->input->post('content');

        if($this->article_model->add($data)) {
            $data['ret'] = 0; //成功
        }else{
            $data['ret'] = 1; //失败
        };
        echo json_encode($data);
    }

    public function article_edit() {
    }

    public function article_update() {
    }

}

