<?php
class Promotor extends Usuario
{

    public function __construct(
        private int $id_promotor = 0,
        private string $nomePublico = "",
        private string $biografia = "",
        private string $telefoneContato = "",
        private string $emailContato = "",
        int $id_usuario = 0,
        string $nome = "",
        string $email = "",
        string $telefone = "",
        string $cpf = "",
        string $senha = "",
        bool $adm = false,
        int $id_website = 0,
        string $url = "",
        $promotor = null
    ) {
        parent::__construct($id_usuario, $nome, $email, $telefone, $cpf, $senha, $adm);
        $this->websites[] = new Website($id_website, $url, $promotor);
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

    public function getWebsites(): array
    {
        return $this->websites;
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

    public function setWebsites(int $id_website, string $url): void
    {
        $this->websites[] = new Website($id_website, $url);
    }
    
    public function setEmailContato(string $emailContato): void
    {
        $this->emailContato = $emailContato;
    }
}
