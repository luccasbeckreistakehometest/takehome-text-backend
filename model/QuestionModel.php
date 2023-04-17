<?php

    class Question {
        private $id;
        private $question;

        private function setId($id){
            $this->id = $id;
        }

        public function getQuestion(){
            return $this->question;
        }
    
        public function setQuestion($question){
            $this->question = $question;
        }

        public function saveQuestion($question) {

        }

        public function create(){

            include('Database.php');

            try{
                $this->generateId();

                $stmt = $con->prepare("INSERT INTO prompt(id, question) VALUES (?, ?) ");
                $stmt->bindParam(1,$this->id);
                $stmt->bindParam(2,$this->question);
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

        public function read(){

            include('Database.php');

            try{
                $stmt = $con->prepare("SELECT * FROM prompt WHERE id = ?");
                $stmt->bindParam(1,$this->id);
                $stmt->execute();

                $dadosCarro = $stmt->fetch(PDO::FETCH_OBJ);

                $this->id = $dadosCarro->marca;
                $this->question = $dadosCarro->modelo;

                return [
                    'success' => true,
                    'message' => 'Data loaded.',   
                ];

            }catch(PDOException $e){

                return [
                    'success' => false,  
                    'message' => $e->getMessage(),  
                ];
            }
            
        }

        // public function update(){

        //     include('Database.php');

        //     try{
        //         $stmt = $con->prepare("UPDATE carro SET marca = ?, modelo = ?, ano = ? WHERE id = ?");
        //         $stmt->bindParam(1,$this->marca);
        //         $stmt->bindParam(2,$this->modelo);
        //         $stmt->bindParam(3,$this->ano);
        //         $stmt->bindParam(4,$this->id);
        //         $stmt->execute();

        //         return [
        //             'success' => true,
        //             'message' => 'Dados do carro atualizados com sucesso.',   
        //         ];

        //     }catch(PDOException $e){

        //         return [
        //             'success' => false,  
        //             'message' => $e->getMessage(),  
        //         ];
        //     }
        // }

        // public function delete(){

        //     include('Database.php');

        //     try{
        //         $stmt = $con->prepare("DELETE FROM carro WHERE id = ?");
        //         $stmt->bindParam(1,$this->id);
        //         $stmt->execute();

        //         return [
        //             'success' => true,
        //             'message' => 'Carro excluído com sucesso com sucesso.',   
        //         ];

        //     }catch(PDOException $e){

        //         return [
        //             'success' => false,  
        //             'message' => $e->getMessage(),  
        //         ];
        //     }
        // }

        public static function list(){

            include('Database.php');

            try{
                $stmt = $con->prepare("SELECT * FROM prompt");
                $stmt->execute();

                $questionList = $stmt->fetchAll(PDO::FETCH_OBJ);
                return [
                    'success' => true,
                    'message' => 'Questions loaded', 
                    'data' => $questionList,  
                ];

            }catch(PDOException $e){

                return [
                    'success' => false,  
                    'message' => $e->getMessage(),  
                ];
            }

        }

        public function jsonMount(){

            return [
                'id' => $this->id,
                'question' => $this->question,
            ];

        }
    }

?>