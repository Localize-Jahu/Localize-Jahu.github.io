<?php
class Usuario
{
    public function __construct(
        private int $id_usuario = 0,
        private string $nome = "",
        private string $email = "",
        private string $telefone = "",
        private string $cpf = "",
        private string $senha = "",
        private string $adm = ""
    ) {}

    public function getIdUsuario(): int
    {
        return $this->id_usuario;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getTelefone(): string
    {
        return $this->telefone;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }


    public function isAdm(): string
    {
        return $this->adm;
    }

    public function setIdUsuario(int $id_usuario): void
    {
        $this->id_usuario = $id_usuario;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setTelefone(string $telefone): void
    {
        $this->telefone = $telefone;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $cpf;
    }

    public function setSenha(string $senha): void
    {
        $this->senha = $senha;
    }

    public function setAdm(string $adm): void
    {
        $this->adm = $adm;
    }
}
