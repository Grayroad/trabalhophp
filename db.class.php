<?php
class db
{
    //servidor
    private $host = 'localhost';
    //usuário
    private $usuario = 'root';
    //senha
    private $senha = '';
    //banco de dados
    private $database = 'db_helpdesk';
    public function conecta_mysql()
    {
        //cria a conexão
        $con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
        //ajustar o charset de comunicação entre a 
        mysqli_set_charset($con, 'utf8');
        //verifica se houve erro na conexão (função retorna o n do erro)
        if (mysqli_connect_errno()) {
            echo 'Erro ao tentar se conectar com o Banco: ' . mysqli_connect_errno();
        }
        return $con;
    }
}
