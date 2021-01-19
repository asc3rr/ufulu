<?php
    class DB{
        private $conn;

        public function __construct(){
            require("config.php");

            $host = $db_conf["host"];
            $user = $db_conf["user"];
            $password = $db_conf["password"];
            $name = $db_conf["name"];

            $this->conn = new mysqli($host, $user, $password, $name);
        }
        public function __destruct(){
            $this->conn->close();
        }

        public function sanitize($data){
            return mysqli_real_escape_string($this->conn, $data);
        }

        public function login($nick, $password){
            $nick= $this->sanitize($nick);
            $password = $this->sanitize($password);

            $check_user_sql = "SELECT * FROM `users` WHERE `nick`='$nick'";

            $result = $this->conn->query($check_user_sql);

            if($result->num_rows > 0){
                $user_data = $result->fetch_assoc();

                return password_verify($password, $user_data['password']);
            }
            else{
                return false;
            }
        }

        public function get_posts(){
            $get_post_sql = "SELECT * FROM `posts` GROUP BY `id` DESC";

            $result = $this->conn->query($get_post_sql);

            if($result->num_rows > 0){
                $posts = array(
                    "code"=>200,
                );

                while($post_data = $result->fetch_assoc()){
                    $post_array = array(
                        "id"=>$post_data["id"],
                        "date"=>$post_data["date"],
                        "content"=>$post_data["content"],
                        "author"=>$post_data["author"]
                    );

                    array_push($posts, $post_array);
                }

                return $posts;
            }
            else{
                $resp = array(
                    "code"=>404
                );

                return $resp;
            }
        }

        public function get_profile($nick){
            $nick = $this->sanitize($nick);

            $get_user_sql = "SELECT id, nick, bio FROM `users` WHERE `nick`='$nick'";

            $result = $this->conn->query($get_user_sql);

            if($result->num_rows > 0){
                $user_array = array(
                    "code"=>200
                );

                $user_data = $result->fetch_assoc();

                $user_array["id"] = $user_data["id"];
                $user_array["nick"] = $user_data["nick"];
                $user_array["bio"] = $user_data["bio"];

                return $user_array;
            }
            else{
                $resp = array(
                    "code"=>404
                );

                return $resp;
            }
        }

        public function update_biogram($nick, $bio){
            $nick = $this->sanitize($nick);
            $bio = $this->sanitize($bio);

            $update_sql = "UPDATE `users` SET `bio`='$bio' WHERE `nick`='$nick'";

            $this->conn->query($update_sql);
        }

        public function update_password($nick, $old, $pass1, $pass2){
            if($this->login($nick, $old)){
                if($pass1 === $pass2){
                    $password_hash = password_hash($pass1, PASSWORD_DEFAULT);

                    $update_sql = "UPDATE `users` SET `password`='$password_hash'";

                    $this->conn->query($update_sql);

                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }

        public function register($nick, $pass1, $pass2){
            $check_user_sql = "SELECT * FROM `users` WHERE `nick`='$nick'";

            $result = $this->conn->query($check_user_sql);

            if($result->num_rows === 0){
                if($pass1 === $pass2){
                    $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

                    $add_user_sql = "INSERT INTO `users` (`id`, `nick`, `password`, `bio`) VALUES (null, '$nick', '$hashed_password', '')";

                    $this->conn->query($add_user_sql);

                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        
        public function add_post($nick, $content){
            $nick = $this->sanitize($nick);
            $content = $this->sanitize(nl2br($content));
            $date = date("Y-m-d");

            $insert_sql = "INSERT INTO `posts` (`id`, `author`, `content`, `date`) VALUES (null, '$nick', '$content', '$date')";

            $this->conn->query($insert_sql);
        }

        public function view_post($id){
            $id = $this->sanitize($id);

            $get_post_sql = "SELECT content, author, date FROM `posts` WHERE `id`=$id";

            $result = $this->conn->query($get_post_sql);

            if($result->num_rows > 0){
                $post_data = $result->fetch_assoc();

                $resp = array();

                $resp['code'] = 200;
                $resp['content'] = $post_data['content'];
                $resp['author'] = $post_data['author'];
                $resp['date'] = $post_data['date'];

                return $resp;
            }
            else{
                $resp = array(
                    "code"=>404
                );

                return $resp;
            }
        }

        public function get_comments($id){
            $sql = "SELECT * FROM `comments` WHERE `post_id`='$id' GROUP BY `id` DESC";

            $result = $this->conn->query($sql);

            if($result->num_rows > 0){
                $posts = array(
                    "code"=>200
                );

                while($post_data = $result->fetch_assoc()){
                    $post_array = array();

                    $post_array["author"] = $post_data["author"];
                    $post_array["content"] = $post_data["content"];

                    array_push($posts, $post_array);
                }

                return $posts;
            }
            else{
                $resp = array(
                    "code"=>404
                );

                return $resp;
            }
        }
    }
?>