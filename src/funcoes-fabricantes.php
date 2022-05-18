<?php
require_once "conecta.php";

// Ler os dados dos fabricantes
function lerFabricantes(PDO $conexao):array {
    $sql = "SELECT id, nome FROM fabricantes ORDER BY nome";
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro: ".$erro->getMessage());
    }
    return $resultado; 
}


// Inserir um fabricante
function inserirFabricante(PDO $conexao, string $nome):void {
    /* :qualquer_coisa -> isso é um named parameter */
    $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";
    try {
        $consulta = $conexao->prepare($sql);

        /* bindParam('nome do parametro', $variavel_com_valor, constante de verificação) */
        $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro: " .$erro->getMessage());
    }
}


function lerUmFabricante($conexao, $id):array {
    $sql = "SELECT id, nome FROM fabricantes WHERE id = :id";

    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $erro) {
        die("Erro: " .$erro->getMessage());
    }
    return $resultado;
}


function atualizarFabricante(PDO $conexao, int $id, string $nome):void {
    $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";
    try {
        $consulta = $conexao->prepare($sql);
        $consulta->bindParam(':id', $id, PDO::PARAM_INT);
        $consulta->bindParam(':nome', $nome, PDO::PARAM_STR);
        $consulta->execute();
    } catch (Exception $erro) {
        die("Erro: " .$erro->getMessage());
    }
}



