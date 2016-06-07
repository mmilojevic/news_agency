<?php

class User_model_test extends TestCase
{
    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('user');
        $this->obj = $this->CI->user;
        
        $this->user_data = [
            "name" => 'Milos Milojevic',
            "email" => 'milos1234@gmail.com',
            "password" =>  md5("test"),
            "active" => 't'
            ];
        $this->obj->db->insert('user',$this->user_data);
    }

    public function test_checkIfUserExists()
    {
        $expected = true;
        $output = $this->obj->checkIfUserExists($this->user_data["email"], 'test');
        $this->assertEquals($expected, $output);
    }
    
    public function tearDown() {
         $this->obj->db->where("name", 'Milos Milojevic')->delete('user');
    }

//    public function test_createNewUser()
//    {
//        $actual = $this->obj->get_category_name(1);
//        $expected = 'Book';
//        $this->assertEquals($expected, $actual);
//    }
}

