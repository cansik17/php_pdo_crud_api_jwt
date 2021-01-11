<?php
    class Articles{

        // Connection
        private $conn;

        // Table
        private $db_table = "articles";

        // Columns
        public $id;
        public $title;
        public $body;
        public $category;


        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function index(){
            $sqlQuery = "SELECT id, title, body, category  FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        // CREATE
        public function store(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        body = :body, 
                        category = :category
                        ";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->body=htmlspecialchars(strip_tags($this->body));
            $this->category=htmlspecialchars(strip_tags($this->category));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":body", $this->body);
            $stmt->bindParam(":category", $this->category);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // READ single
        public function show(){
            $sqlQuery = "SELECT
                        id, 
                        title, 
                        body, 
                        category
                      FROM
                        ". $this->db_table ."
                    WHERE 
                       id = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->id);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->title = $dataRow['title'];
            $this->body = $dataRow['body'];
            $this->category = $dataRow['category'];
        }        

        // UPDATE
        public function update(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        title = :title, 
                        body = :body, 
                        category = :category
                    WHERE 
                        id = :id";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->title=htmlspecialchars(strip_tags($this->title));
            $this->body=htmlspecialchars(strip_tags($this->body));
            $this->category=htmlspecialchars(strip_tags($this->category));
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            // bind data
            $stmt->bindParam(":title", $this->title);
            $stmt->bindParam(":body", $this->body);
            $stmt->bindParam(":category", $this->category);
            $stmt->bindParam(":id", $this->id);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function destroy(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->id=htmlspecialchars(strip_tags($this->id));
        
            $stmt->bindParam(1, $this->id);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    }
