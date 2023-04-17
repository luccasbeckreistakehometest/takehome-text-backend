<?php

    class Answer {
        private $userId;
        private $questionId;
        private $answer;

        public function getUserId(){
            return $this->userId;
        }
    
        public function setUserId($userId){
            $this->userId = $userId;
        }
    
        public function getQuestionId(){
            return $this->questionId;
        }
    
        public function setQuestionId($questionId){
            $this->questionId = $questionId;
        }
    
        public function getAnswer(){
            return $this->answer;
        }
    
        public function setAnswer($answer){
            $this->answer = $answer;
        }

        public function create(){

            include('Database.php');

            try{

                $stmt = $con->prepare("INSERT INTO answer(id_user, id_question, answer) VALUES (?, ?, ?) ");
                $stmt->bindParam(1,$this->userId);
                $stmt->bindParam(2,$this->questionId);
                $stmt->bindParam(3,$this->answer);
                $stmt->execute();

                return [
                    'success' => true,
                ];

            }catch(PDOException $e){

                return [
                    'success' => false,  
                    'message' => $e->getMessage(),  
                ];
            }
        }

    }

?>