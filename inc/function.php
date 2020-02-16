<?php


function checkEmailExist($email_saisi)
{
  global $bdd;

  $sql = 'SELECT email FROM users WHERE email = :check_email';
  $check = $bdd->prepare($sql);
  $check->bindValue(':check_email', $email_saisi);
  $check->execute();

  $has_email = $check->fetch();

  if(!empty($has_email)){
    return true;
  }
  else {
    return false;
  }

}


function checkUsernameExist($find_username)
{
  global $bdd;

  $sql = 'SELECT username FROM users WHERE username = :check_username';
  $check = $bdd->prepare($sql);
  $check->bindValue(':check_username', $find_username);
  $check->execute();

  $username_exist = $check->fetch();

  if(!empty($username_exist)){
    return true;
  }
  else {
    return false;
  }

}
