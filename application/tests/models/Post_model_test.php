<?php

class Post_model_test extends TestCase
{
    public $posts, $user_data;
            
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('post');
        $this->obj = $this->CI->post;
        
        $this->user_data = [
            "name" => 'Milos Milojevic TEST',
            "email" => 'test_milos1234@gmail.com',
            "password" =>  "test",
            "active" => 't'
            ];
        $this->obj->db->insert('user', $this->user_data);
        $this->user_data["id"] = $this->obj->db->insert_id();
        
        $this->posts = [];
        $post_data = [
            "id_user" => $this->user_data["id"],
            "title" => 'Breaking post, you must read this!',
            "body" =>  "The androids from earth have successfully landed on pluto. "
            . " As they say Pluto is beautifull place to live",
            "image" => 'dummy1.jpg'
            ];
        $this->obj->db->insert('post', $post_data);
        $post_data["id"] = (int)$this->obj->db->insert_id();
        $this->posts[] = $post_data;
        
        $post_data = [
            "id_user" => $this->user_data["id"],
            "title" => 'Second breaking post, you must read this!',
            "body" =>  "Second army of androids from earth have successfully landed on pluto. "
            . " As they say Pluto is beautifull place to live",
            "image" => 'dummy2.jpg'
            ];
        $this->obj->db->insert('post', $post_data);
        $post_data["id"] = (int)$this->obj->db->insert_id();
        $this->posts[] = $post_data;
        
        $post_data = [
            "id_user" => $this->user_data["id"],
            "title" => 'Third breaking post, you must read this!',
            "body" =>  "Third army of androids from earth have successfully landed on pluto. "
            . " As they say Pluto is beautifull place to live",
            "image" => 'dummy3.jpg'
            ];
        $this->obj->db->insert('post', $post_data);
        $post_data["id"] = (int)$this->obj->db->insert_id();
        $this->posts[] = $post_data;
        
        $post_data = [
            "id_user" => $this->user_data["id"],
            "title" => 'Fourth breaking news, you must read this!',
            "body" =>  "Fourt army of androids from earth have successfully landed on pluto. "
            . " As they say Pluto is beautifull place to live",
            "image" => 'dummy4.jpg'
            ];
        $this->obj->db->insert('post', $post_data);
        $post_data["id"] = (int)$this->obj->db->insert_id();
        $this->posts[] = $post_data;
    }

    public function test_getPost()
    {
        $expected = $this->posts[0];
        unset($expected["id_user"]);
        $output = $this->obj->getPost($this->posts[0]["id"]);
        unset($output["editor_name"]);
        unset($output["editor_email"]);
        unset($output["edited"]);
        
        $this->assertEquals($expected, $output);
    }
    
    public function test_getLatestPosts()
    {
        $expected = 2;
        $output = $this->obj->getLatestPosts(2);
        $this->assertEquals($expected, count($output));
    }
    
    public function test_getPostsForUser()
    {
        $expected = 4;
        $output = $this->obj->getPostsForUser($this->user_data["id"]);
        $this->assertEquals($expected, count($output));
    }
    
    public function test_addPost()
    {
        $post_data = [
            "image_name" => "dummy5",
            "id_user" => $this->user_data["id"],
            "title" => 'Fifth breaking news, you must read this!',
            "post" =>  "Fifth army of androids from earth have successfully landed on pluto. "
            . " As they say Pluto is beautifull place to live",
            ];
        
        $expected = true;
        $output = $this->obj->addPost($post_data);
        $this->assertEquals($expected, is_string($output));
    }
    
    public function test_deletePost(){
        $expected = null;
        $this->obj->deletePost($this->posts[0]["id"]);
        $output = $this->obj->db->select('id')
                ->from('post')->
                where('id', $this->posts[0]["id"])->get()->row_array();
        $this->assertEquals($expected, $output);
    }
    
    public function tearDown() {
        $this->obj->db->where("id_user", $this->user_data["id"])->delete('post');
        $this->obj->db->where("id", $this->user_data["id"])->delete('user');
    }
    

}

