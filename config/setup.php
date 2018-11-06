<?php

include 'database.php';

  try {
      $conn = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $sql = 'CREATE DATABASE IF NOT EXISTS db_matcha;';
      $conn->exec($sql);

      echo "Matcha database created\n";

      $sql = 'USE db_matcha;';

      $conn->exec($sql);
      $sql = "CREATE TABLE IF NOT EXISTS users 
      (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      username varchar(30) NOT NULL UNIQUE, 
      fname varchar(30) NOT NULL, 
      lname varchar(30) NOT NULL, 
      password varchar(128) NOT NULL, 
      email varchar(50) NOT NULL UNIQUE, 
      hashed varchar(32) NOT NULL UNIQUE,
      meta INT NOT NULL DEFAULT '0');"; 

      $conn->exec($sql);
      echo "Matcha users table created\n";
      echo "users table created\n";


      $sql = "CREATE TABLE IF NOT EXISTS profiles 
      (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      username varchar(30) NOT NULL UNIQUE, 
      gender ENUM('male', 'female', 'male+female'), 
      sex_pref ENUM('male', 'female', 'male+female'), 
      age INT, 
      biography varchar(10000), 
      interests TEXT, 
      latitude varchar(20), 
      longitude varchar(20), 
      hidden ENUM('no', 'yes'));";


      $conn->exec($sql);
      echo "profiles table created\n";

      $sql = 'CREATE TABLE IF NOT EXISTS pictures 
      (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE, 
      username varchar(30) NOT NULL, 
      pic_path_and_name varchar(28), 
      pic_number INT);';

      $conn->exec($sql);
      echo "pictures table created\n";


      $sql = 'CREATE TABLE IF NOT EXISTS public 
      (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
      username varchar(30) NOT NULL UNIQUE, 
      likes INT NOT NULL DEFAULT "0", 
      who_liked TEXT, 
      views INT NOT NULL DEFAULT "0", 
      who_viewed TEXT, 
      blocked TEXT, 
      who_blocked TEXT, 
      visited TEXT);';

      $conn->exec($sql);
      echo "public table created\n";

      $sql = 'CREATE TABLE IF NOT EXISTS contacts
      (cont_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      first_name VARCHAR(30) NOT NULL,
      last_name VARCHAR(30) NOT NULL,
      continent VARCHAR(30) NOT NULL,
      comment VARCHAR(30) NOT NULL);';

      $conn->exec($sql);
      echo "Contacts table created\n";

      $sql = 'CREATE TABLE IF NOT EXISTS chats
      (chat_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      message VARCHAR(1000) NOT NULL);';

      $conn->exec($sql);
      echo "Chats table created\n";


      ####################################
      $a_user = 'admin';
      $a_fname = 'mudenda';
      $a_lname = 'muntanga';
      $a_passwd = hash('whirlpool', 'admin');
      $a_email = 'mmuntang@student.wethinkcode.co.za';
      $a_hashed = md5('admin');
      $a_meta = 2;
      $a_gender = 'male';
      $a_sex_pref = 'female';
      $a_age = 18;
      $a_bio = 'The Boss of this site!';
      $a_interests = '#Flips#FlatCaps#SnapBacks#SugarBay#You#RightBicept#Rats';
      $a_interests = preg_split("/[\s,#]+/", $a_interests);
      $a_interests = array_filter($a_interests);
      $a_interests = implode(", \n", $a_interests);
      $a_pic_path_and_name = './uploads/1.jpg';
      $a_pic_number = 1;

      $sql = $conn->prepare('INSERT IGNORE INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, ?);');
      $sql->execute([$a_user, $a_fname, $a_lname, $a_passwd, $a_email, $a_hashed, $a_meta]);
      $sql = $conn->prepare('INSERT IGNORE INTO profiles (username, gender, sex_pref, age, biography, interests) VALUES (?, ?, ?, ?, ?, ?);');
      $sql->execute([$a_user, $a_gender, $a_sex_pref, $a_age, $a_bio, $a_interests]);
      $sql = $conn->prepare('INSERT IGNORE INTO public (username) VALUES (?);');
      $sql->execute([$a_user]);
      $sql = $conn->prepare('INSERT IGNORE INTO pictures (username, pic_path_and_name, pic_number) VALUES (?, ?, ?);');
      $sql->execute([$a_user, $a_pic_path_and_name, $a_pic_number]);

      echo "admin user inserted\n";

       ####################################
       $a_user = 'admin1';
       $a_fname = 'john';
       $a_lname = 'doe';
       $a_passwd = hash('whirlpool', 'admin1');
       $a_email = 'john@mail.com';
       $a_hashed = md5('admin1');
       $a_meta = 2;
       $a_gender = 'female';
       $a_sex_pref = 'male';
       $a_age = 18;
       $a_bio = 'The Second Boss of this site!';
       $a_interests = '#Fun#bikinilover#Sexy#cute#mwahh#';
       $a_interests = preg_split("/[\s,#]+/", $a_interests);
       $a_interests = array_filter($a_interests);
       $a_interests = implode(", \n", $a_interests);
       $a_pic_path_and_name = './uploads/2.jpg';
       $a_pic_number = 2;
 
       $sql = $conn->prepare('INSERT IGNORE INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, ?);');
       $sql->execute([$a_user, $a_fname, $a_lname, $a_passwd, $a_email, $a_hashed, $a_meta]);
       $sql = $conn->prepare('INSERT IGNORE INTO profiles (username, gender, sex_pref, age, biography, interests) VALUES (?, ?, ?, ?, ?, ?);');
       $sql->execute([$a_user, $a_gender, $a_sex_pref, $a_age, $a_bio, $a_interests]);
       $sql = $conn->prepare('INSERT IGNORE INTO public (username) VALUES (?);');
       $sql->execute([$a_user]);
       $sql = $conn->prepare('INSERT IGNORE INTO pictures (username, pic_path_and_name, pic_number) VALUES (?, ?, ?);');
       $sql->execute([$a_user, $a_pic_path_and_name, $a_pic_number]);
 
       echo "admin1 user inserted\n";

        ####################################
      $a_user = 'admin2';
      $a_fname = 'jon';
      $a_lname = 'doe';
      $a_passwd = hash('whirlpool', 'admin2');
      $a_email = 'jon@doe.com';
      $a_hashed = md5('admin2');
      $a_meta = 2;
      $a_gender = 'male';
      $a_sex_pref = 'female';
      $a_age = 35;
      $a_bio = 'The Brains to this site!';
      $a_interests = '#veryfune#FlatCaps#SnapBacks#SugarBay#You#RightBicept#Rats';
      $a_interests = preg_split("/[\s,#]+/", $a_interests);
      $a_interests = array_filter($a_interests);
      $a_interests = implode(", \n", $a_interests);
      $a_pic_path_and_name = './uploads/3.jpg';
      $a_pic_number = 3;

      $sql = $conn->prepare('INSERT IGNORE INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, ?);');
      $sql->execute([$a_user, $a_fname, $a_lname, $a_passwd, $a_email, $a_hashed, $a_meta]);
      $sql = $conn->prepare('INSERT IGNORE INTO profiles (username, gender, sex_pref, age, biography, interests) VALUES (?, ?, ?, ?, ?, ?);');
      $sql->execute([$a_user, $a_gender, $a_sex_pref, $a_age, $a_bio, $a_interests]);
      $sql = $conn->prepare('INSERT IGNORE INTO public (username) VALUES (?);');
      $sql->execute([$a_user]);
      $sql = $conn->prepare('INSERT IGNORE INTO pictures (username, pic_path_and_name, pic_number) VALUES (?, ?, ?);');
      $sql->execute([$a_user, $a_pic_path_and_name, $a_pic_number]);

      echo "admin2 user inserted\n";

       ####################################
       $a_user = 'admin3';
       $a_fname = 'beyonce';
       $a_lname = 'carter';
       $a_passwd = hash('whirlpool', 'admin3');
       $a_email = 'queenb@bee.com';
       $a_hashed = md5('admin3');
       $a_meta = 2;
       $a_gender = 'female';
       $a_sex_pref = 'male';
       $a_age = 40;
       $a_bio = 'The face of this site!';
       $a_interests = '#Flips#FlatCaps#SnapBacks#SugarBay#You#RightBicept#Rats';
       $a_interests = preg_split("/[\s,#]+/", $a_interests);
       $a_interests = array_filter($a_interests);
       $a_interests = implode(", \n", $a_interests);
       $a_pic_path_and_name = './uploads/4.jpg';
       $a_pic_number = 4;
 
       $sql = $conn->prepare('INSERT IGNORE INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, ?);');
       $sql->execute([$a_user, $a_fname, $a_lname, $a_passwd, $a_email, $a_hashed, $a_meta]);
       $sql = $conn->prepare('INSERT IGNORE INTO profiles (username, gender, sex_pref, age, biography, interests) VALUES (?, ?, ?, ?, ?, ?);');
       $sql->execute([$a_user, $a_gender, $a_sex_pref, $a_age, $a_bio, $a_interests]);
       $sql = $conn->prepare('INSERT IGNORE INTO public (username) VALUES (?);');
       $sql->execute([$a_user]);
       $sql = $conn->prepare('INSERT IGNORE INTO pictures (username, pic_path_and_name, pic_number) VALUES (?, ?, ?);');
       $sql->execute([$a_user, $a_pic_path_and_name, $a_pic_number]);
 
       echo "admin3 user inserted\n";

        ####################################
      $a_user = 'admin4';
      $a_fname = 'lil';
      $a_lname = 'weezy';
      $a_passwd = hash('whirlpool', 'admin4');
      $a_email = 'weezy@ymcmb.com';
      $a_hashed = md5('admin4');
      $a_meta = 2;
      $a_gender = 'male';
      $a_sex_pref = 'female';
      $a_age = 39;
      $a_bio = 'The talent of this site!';
      $a_interests = '#thegreatestrapperalive#SugarBay#You#RightBicept#Rats';
      $a_interests = preg_split("/[\s,#]+/", $a_interests);
      $a_interests = array_filter($a_interests);
      $a_interests = implode(", \n", $a_interests);
      $a_pic_path_and_name = './uploads/5.jpg';
      $a_pic_number = 5;

      $sql = $conn->prepare('INSERT IGNORE INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, ?);');
      $sql->execute([$a_user, $a_fname, $a_lname, $a_passwd, $a_email, $a_hashed, $a_meta]);
      $sql = $conn->prepare('INSERT IGNORE INTO profiles (username, gender, sex_pref, age, biography, interests) VALUES (?, ?, ?, ?, ?, ?);');
      $sql->execute([$a_user, $a_gender, $a_sex_pref, $a_age, $a_bio, $a_interests]);
      $sql = $conn->prepare('INSERT IGNORE INTO public (username) VALUES (?);');
      $sql->execute([$a_user]);
      $sql = $conn->prepare('INSERT IGNORE INTO pictures (username, pic_path_and_name, pic_number) VALUES (?, ?, ?);');
      $sql->execute([$a_user, $a_pic_path_and_name, $a_pic_number]);

      echo "admin4 user inserted\n";

       ####################################
       $a_user = 'admin5';
       $a_fname = 'miley';
       $a_lname = 'cyrus';
       $a_passwd = hash('whirlpool', 'admin5');
       $a_email = 'miley@cyrus.com';
       $a_hashed = md5('admin5');
       $a_meta = 2;
       $a_gender = 'female';
       $a_sex_pref = 'male';
       $a_age = 21;
       $a_bio = 'The voice of this site!';
       $a_interests = '#Flips#FlatCaps#SnapBacks#SugarBay#You#RightBicept#Rats';
       $a_interests = preg_split("/[\s,#]+/", $a_interests);
       $a_interests = array_filter($a_interests);
       $a_interests = implode(", \n", $a_interests);
       $a_pic_path_and_name = './uploads/6.jpg';
       $a_pic_number = 6;
 
       $sql = $conn->prepare('INSERT IGNORE INTO users (username, fname, lname, password, email, hashed, meta) VALUES (?, ?, ?, ?, ?, ?, ?);');
       $sql->execute([$a_user, $a_fname, $a_lname, $a_passwd, $a_email, $a_hashed, $a_meta]);
       $sql = $conn->prepare('INSERT IGNORE INTO profiles (username, gender, sex_pref, age, biography, interests) VALUES (?, ?, ?, ?, ?, ?);');
       $sql->execute([$a_user, $a_gender, $a_sex_pref, $a_age, $a_bio, $a_interests]);
       $sql = $conn->prepare('INSERT IGNORE INTO public (username) VALUES (?);');
       $sql->execute([$a_user]);
       $sql = $conn->prepare('INSERT IGNORE INTO pictures (username, pic_path_and_name, pic_number) VALUES (?, ?, ?);');
       $sql->execute([$a_user, $a_pic_path_and_name, $a_pic_number]);
 
       echo "admin5 user inserted\n";
}

catch(PDOException $e)
{
    echo 'Error: ' . $e->getmessage();
}
?>