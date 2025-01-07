<?php

use PHPUnit\Framework\TestCase;
require('user_sql.php');


class UserProfileTest extends TestCase
{
    public function testValidateUserProfileForm()
    {
        $input_data = [
            'username' => '',
            'first_name' => '',
            'last_name' => '',
            'email' => 'invalid-email',
            'address' => '',
            'postcode' => '',
            'phone_number' => ''
        ];

        $errors = [];
        
        // Simulating POST request values
        foreach ($input_data as $key => $value) {
            $_POST[$key] = $value;
        }

        // Call your form validation logic here
        // Validate username
        if (empty($input_data['username'])) $errors[] = "Username is required.";
        
        // Validate first name
        if (empty($input_data['first_name'])) $errors[] = "First name is required.";

        // Validate last name
        if (empty($input_data['last_name'])) $errors[] = "Last name is required.";

        // Validate email
        if (empty($input_data['email']) || !filter_var($input_data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid email is required.";
        }

        // Assert that errors are generated
        $this->assertGreaterThan(0, count($errors));
        $this->assertContains("Username is required.", $errors);
        $this->assertContains("Valid email is required.", $errors);
    }

    public function testUpdateUserProfile()
{
    $user_id = 30;
    $username = 'testuser';
    $first_name = 'Test';
    $last_name = 'User';
    $date_of_birth = '2000-01-01';
    $email = 'testuser@example.com';
    $address = '123 Test St';
    $postcode = '12345';
    $phone_number = '5551234566';

    // Ensure the user exists before updating
    $user = get_user($user_id);
    $this->assertNotNull($user, "User does not exist");

    // Update the user profile
    $result = update_user_profile($user_id, $username, $first_name, $last_name, $date_of_birth, $email, $address, $postcode, $phone_number);

    // Assert that the update was successful
    $this->assertTrue($result, "Failed to update user profile");

    // Verify the updated user profile
    $updated_user = get_user($user_id);
    $this->assertEquals($username, $updated_user['username']);
    $this->assertEquals($first_name, $updated_user['first_name']);
    $this->assertEquals($last_name, $updated_user['last_name']);
    $this->assertEquals($date_of_birth, $updated_user['date_of_birth']);
    $this->assertEquals($email, $updated_user['email']);
    $this->assertEquals($address, $updated_user['address']);
    $this->assertEquals($postcode, $updated_user['postcode']);
    $this->assertEquals($phone_number, $updated_user['phone_number']);
}
}





?>