<?php
class Evento
{

    public function __construct(
        private int $id_evento = 0,
        private string $titulo = "",
        private string $imagem = "",
        private string $descricao = "",
        private string $uf = "",
        private string $cidade = "",
        private string $bairro = "",
        private string $logradouro = "",
        private string $cep = "",
        private string $situacao = "",
        private $categoria = null,
        private	$promotor = null,
        private int $acessos = 0
    ) {
    }

    public function getId_evento(): int
    {
        return $this->id_evento;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function getImagem(): string
    {
        return $this->imagem;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function getUf(): string
    {
        return $this->uf;
    }

    public function getCidade(): string
    {
        return $this->cidade;
    }

    public function getBairro(): string
    {
        return $this->bairro;
    }

    public function getLogradouro(): string
    {
        return $this->logradouro;
    }

    public function getCep(): string
    {
        return $this->cep;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getSituacao(): string
    {
        return $this->situacao;
    }

    public function getOcorrencias(): array
    {
        return $this->ocorrencias;
    }

    public function getPromotor()
    {
        return $this->promotor;
    }

    public function getAcessos(): int
    {
        return $this->acessos;
    }

    public function setId_evento(int $id_evento): void
    {
        $this->id_evento = $id_evento;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function setImagem(string $imagem): void
    {
        $this->imagem = $imagem;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function setUf(string $uf): void
    {
        $this->uf = $uf;
    }

    public function setCidade(string $cidade): void
    {
        $this->cidade = $cidade;
    }

    public function setBairro(string $bairro): void
    {
        $this->bairro = $bairro;
    }

    public function setLogradouro(string $logradouro): void
    {
        $this->logradouro = $logradouro;
    }

    public function setCep(string $cep): void
    {
        $this->cep = $cep;
    }

    public function setSituacao(string $situacao): void
    {
        $this->situacao = $situacao;
    }

    public function setCategoria(Categoria $categoria): void
    {
        $this->categoria = $categoria;
    }

    public function setOcorrencias(int $id_ocorrencia, string $dia, string $horaInicio, string $horaTermino): void
    {
        $this->ocorrencias[] = new Ocorrencia($id_ocorrencia, $dia, $horaInicio, $horaTermino);
    }

    public function setPromotor(Promotor $promotor): void
    {
        $this->promotor = $promotor;
    }

    public function setAcessos(int $acessos): void
    {
        $this->acessos = $acessos;
    }
}