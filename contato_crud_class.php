
<?php
class Contato {

    private $pdo;
    public function __construct() {
		$this->pdo = new PDO("mysql:dbname=crudoo;host=localhost", "root", "");
	}
    public function adicionar ($email, $nome = ''){
        if($this->existeEmail($email) == false){
            $sql = "INSERT INTO contato (nome, email) VALUES (:nome, :email)";
            $sql = $this->pdo->prepare($sql);
            $sql ->bindValue(':nome', $nome);
            $sql ->bindValue(':email', $email);
            $sql->execute();
            return true;
        }   
        else{
            return false;
        }
    }
    public function getInfo($id){
        $sql = "SELECT * FROM contato WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql -> bindValue(':id', $id);
        $sql -> execute();

        if($sql->rowCount() > 0){
            return $sql->fetch();
        }
        else{
            return array();
        }
    }
    public function getAll(){
        $sql = "SELECT * FROM contato";
        $sql = $this->pdo->query($sql);
        if($sql->rowCount() > 0){
            return $sql->fetchAll();
        }
        else{
            return array();
        }
    }
    public function editar($nome, $email, $id){
        if($this->existeEmail($email) == false){
            $sql = "UPDATE contato SET nome = :nome, email = :email WHERE id = :id";
            $sql = $this->pdo->prepare($sql);
            $sql->bindValue(':nome', $nome);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':id', $id);
            $sql->execute();
            return true;
        }
        else{
            return false;
        }
    }
    public function excluirPeloId($id){
        $sql = "DELETE FROM contato WHERE id = :id";
        $sql = $this->pdo->prepare($sql);
        $sql -> bindValue(':id', $id);
        $sql -> execute();
    }
    public function excluirPeloEmail($email){
        $sql = "DELETE FROM contato WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql -> bindValue(':email', $email);
        $sql -> execute();
    }
    private function existeEmail($email){
        $sql = "SELECT * FROM contato WHERE email = :email";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':email', $email);
        $sql->execute();
        if($sql -> rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
?>