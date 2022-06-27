<?php
namespace Crud;
use PDO, Exception;

class Fabricante {
    private int $id;
    private string $nome;

    // Essa propriedade receberá os recursos PDO através da classe Banco (dependência do projeto)
    // public PDO $conexao;
    private PDO $conexao;

    public function __construct()
    {
        // No momento em que for criado um objeto a partir da classe Fabricante, automaticamente será feita a conexao com o banco 
        $this->conexao = Banco::conecta();
    }

    function lerFabricantes():array {
        $sql = "SELECT id, nome FROM fabricantes ORDER BY nome";
        try {
            $consulta = $this->$conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro: ".$erro->getMessage());
        }
        return $resultado; 
    }

    public function getId():int
    {
        return $this->id;
    }


    public function setId(int $id)
    {
        $this->id = $id;
    }


    public function getNome():string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
    }

}


?>