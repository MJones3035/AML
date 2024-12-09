<?php

class Test extends \PHPUnit\Framework\TestCase {

    // public function test1() {
    //     $a = 1;
    //     $b = 1;

    //     $this->assertSame($a, $b);
    // }

    // merthod has to start with the word test or it won't be reconised
    public function test_user_login() {
        require 'user_sql.php';

        //the test user account is test3 2222222222

        // authorise match
        $result = authorise_user("test3", "2222222222");

        $expected = ['status' => AuthoriseStates::MATCH, 'user_id' => 30];

        $this->assertEquals($expected['status'], $result['status'], 'Testing if the status matches');
        $this->assertEquals($expected['user_id'], $result['user_id'], 'Testing if the user_id matches');

        // authorise invalid password
        $result = authorise_user("test3", "2");

        $expected = ['status' => AuthoriseStates::INVALID_PASSWORD];

        $this->assertEquals($expected['status'], $result['status'], 'Testing if the status matches');
        $this->assertArrayNotHasKey('user_id', $result, 'Testing if the user_id exists');

        // authorise invalid both
        $result = authorise_user("test111", "2");

        $expected = ['status' => AuthoriseStates::INVALID_BOTH];

        $this->assertEquals($expected['status'], $result['status'], 'Testing if the status matches');
        $this->assertArrayNotHasKey('user_id', $result, 'Testing if the user_id exists');

        // active user
        $result = is_user_active(30);

        $expected = true;

        $this->assertSame($expected, $result, 'Testing if the user is active');

        // inactive user
        $result = is_user_active(29);

        $expected = false;

        $this->assertSame($expected, $result, 'Testing if the user is not active');

    }

    public function test_sign_up() {
        //require 'user_sql.php';
        require 'email_sql.php';

        // create user
        $data = array(
            'username' => 'test10',
            'first_name' => 'a',
            'last_name' => 'a',
            'date_of_birth' => '2000-12-03',
            'phone' => '01',
            'email' => 'matthewjones3035@gmail.com',
            'address' => 'a',
            'postcode' => 'a',
            'password' => '1111111111',
            'activation_code' => generate_random_code()
        );

        $result = create_user($data, Roles::USER);

        $expected = true;

        $this->assertSame($expected, $result, 'Testing if a user can be created');


        // check if username exists
        $result = does_username_exist('test10');

        $expected = true;

        $this->assertSame($expected, $result, 'Testing if a username exists');


        // send mail
        $result = send_email($data['email'], "Testing", "Testing");

        $expected = "Mail has been sent successfully!";

        $this->assertSame($expected, $result, 'Testing if a mail can be sent');


        // check if in table
        $result = get_user_id_by_username($data['username']);

        $new_user_id = $result['user_id'];

        $this->assertArrayHasKey('user_id', $result, 'Testing if the create user exists in the credentials table');


        // activate user
        $result = activate_user($new_user_id);

        $expected = true;

        $this->assertSame($expected, $result, 'Testing if a user can be activated');
        $this->assertSame(true, is_user_active($new_user_id), 'Testing if the user has been activated');


        // delete new test user
        $result = delete_user($new_user_id);

        $expected = true;

        $this->assertSame($expected, $result, 'Testing if the new created user has been deleted');

    }
}