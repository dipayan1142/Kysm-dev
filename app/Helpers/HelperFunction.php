<?php

namespace App\Helpers;

use App\Models\User;
use App\Helpers\Mailer;
use Illuminate\Support\Facades\Hash;

class HelperFunction
{
  public function generatePassword($length = 9, $available_sets = 'luds', $add_dashes = false)
  {
    $sets = array();
    if (strpos($available_sets, 'l') !== false) {
      $sets[] = 'abcdefghjkmnpqrstuvwxyz';
    }
    if (strpos($available_sets, 'u') !== false) {
      $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
    }
    if (strpos($available_sets, 'd') !== false) {
      $sets[] = '23456789';
    }
    if (strpos($available_sets, 's') !== false) {
      $sets[] = '!@#%&*?';
    }
    $all = $password = '';
    foreach ($sets as $set) {
      $password .= $set[array_rand(str_split($set))];
      $all      .= $set;
    }

    $all = str_split($all);
    for ($i = 0; $i < $length - count($sets); $i++) {
      $password .= $all[array_rand($all)];
    }

    $password = str_shuffle($password);

    if (!$add_dashes) {
      return $password;
    }

    $dash_len = floor(sqrt($length));
    $dash_str = '';
    while (strlen($password) > $dash_len) {
      $dash_str .= substr($password, 0, $dash_len) . '-';
      $password  = substr($password, $dash_len);
    }
    $dash_str .= $password;
    return $dash_str;
  } //end generatePassword()

  public static function createUser($name, $email, $type, $phone, $parent_id=NULL, $image = NULL)
  {
    // Generate Password
    $randPass = self::generatePassword($length = 9, $available_sets = 'luds', $add_dashes = false);
    $hashedPass = Hash::make($randPass);

    // Create user
    $user = User::create(array(
      "email" => $email,
      "name" => $name,
      "role" => $type,
      "phone" => $phone,
      "password" => $hashedPass,
      "image" => $image ? $image : NULL,
      'parent_id' => $parent_id ? $parent_id : 0
    ));

    // Send mail
    $emailSubject = "Login Credentials for __--";
    $emailText = "<html>
        <body>
        <h4>Welcome " . $name . " to ___ Portal. You have been added as " . $type . " member. You can access the portal by using the credentials mentioned below.</h4>
        <h4>Portal Link:- " . getenv('APP_URL') . "</h4>
        <h4>User Id:- " . $email . "</h4>
        <h4>Password:- " . $randPass . "</h4>
        <p>Please change the password after login for security reasons.</p>
        <p>Thank You. Regards.</p>
        <p>Team Zeeshan</p>
        </body>
        </html>";
   $data= Mailer::sendMail($email, $emailSubject, $emailText);
    return $user->id;
  }

}
