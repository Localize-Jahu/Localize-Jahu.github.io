<?php
class Promotor extends Usuario
{

    public function __construct(
        private int $id_promotor = 0,
        private string $nomePublico = "",
        private string $biografia = "",
        private string $telefoneContato = "",
        private string $emailContato = "",
        private string $website = "",
        int $id_usuario = 0,
        string $nome = "",
        string $email = "",
        string $telefone = "",
        string $cpf = "",
        string $senha = "",
        bool $adm = false
    ) {
        parent::__construct($id_usuario, $nome, $email, $telefone, $cpf, $senha, $adm);
       
    }


    public function getID(): int
    {
        return $this->id_promotor;
    }


    public function getNomePublico(): string
    {
        return $this->nomePublico;
    }

    public function getEmailContato(): string
    {
        return $this->emailContato;
    }

    public function getBiografia(): string
    {
        return $this->biografia;
    }

    public function getTelefoneContato(): string
    {
        return $this->telefoneContato;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setID(int $id_promotor): void
    {
        $this->id_promotor = $id_promotor;
    }

    public function setNomePublico(string $nomePublico): void
    {
        $this->nomePublico = $nomePublico;
    }

    public function setBiografia(string $biografia): void
    {
        $this->biografia = $biografia;
    }

    public function setTelefoneContato(string $telefoneContato): void
    {
        $this->telefoneContato = $telefoneContato;
    }

    public function setWebsite( string $website)
    {
       $this -> website = $website;
    }
    public function setEmailContato(string $emailContato): void
    {
        $this->emailContato = $emailContato;
    }
}
