<?php

class User_model_test extends TestCase
{
    public $user_data, $id_user;
            
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('user');
        $this->obj = $this->CI->user;
        
        $this->user_data = [
            "name" => 'Milos Milojevic TEST',
            "email" => 'test_milos1234@gmail.com',
            "password" =>  "test",
            "active" => 't'
            ];
    }

    public function test_checkIfUserExists()
    {
        $db_insert_data =  $this->user_data;
        $db_insert_data["password"] = md5($db_insert_data["password"]);
        $this->obj->db->insert('user',$db_insert_data);
        $this->id_user = $this->obj->db->insert_id();
                
        $expected = 3;
        $output = $this->obj->getActiveUserIfExists($this->user_data["email"], $this->user_data["password"]);
        $this->assertEquals($expected, count($output));
        $this->obj->db->where("id", $this->id_user)->delete('user');
    }
    
    public function test_createNewUser()
    {
        $output = $this->obj->createNewUser($this->user_data);
        $this->id_user = $output;
        
        $expected = $this->id_user;
        $this->assertEquals($expected, $output);
        $this->obj->db->where("id", $this->id_user)->delete('user');
    }
    
    public function test_updatePassword()
    {
        $db_insert_data =  $this->user_data;
        $db_insert_data["password"] = md5($db_insert_data["password"]);
        $this->obj->db->insert('user',$db_insert_data);
        $this->id_user = $this->obj->db->insert_id();
        
        $expected = 'new_test';
        $this->obj->updatePassword(["id" => $this->id_user, "password" => $expected]);
        $output = $this->obj->db->select('password')
                ->from('user')
                ->where('id', $this->id_user)
                ->get()->row_array()["password"];
        
        $this->assertEquals( md5($expected), $output);
        $this->obj->db->where("id", $this->id_user)->delete('user');
    }
    
    public function test_sendMail() {
        $expected = true; 
        $output = $this->obj->sendMail("info@news.com",  $this->user_data["email"], 'Test', 'Hello!');
        $this->assertEquals($expected, $output);
    }
    
    
//    public function tearDown() {
//        $this->obj->db->where("id", $this->id_user)->delete('user');
//    }
    

}

