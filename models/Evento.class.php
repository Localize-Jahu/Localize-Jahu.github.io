<?php
class Evento
{
    public function __construct(
        private int $id_evento = 0,
        private string $descricao = "",
        private string $titulo = "",
        private string $logradouro = "",
        private string $cep = "",
        private string $bairro = "",
        private string $cidade = "",
        private string $uf = "",
        private string $situacao = "",
        private string $imagem = "",
        private $categoria = null,
        private $promotor = null
    ) {}
    public function getId_evento()
    {
        return $this->id_evento;
    }
    public function getDescricao()
    {
        return $this->descricao;
    }
    public function getTitulo()
    {
        return $this->titulo;
    }
    public function getLogradouro()
    {
        return $this->logradouro;
    }
    public function getCep()
    {
        return $this->cep;
    }
    public function getBairro()
    {
        return $this->bairro;
    }
    public function getCidade()
    {
        return $this->cidade;
    }
    public function getUf()
    {
        return $this->uf;
    }
    public function getSituacao()
    {
        return $this->situacao;
    }
    public function getImagem()
    {
        return $this->imagem;
    }
    public function getCategoria()
    {
        return $this->categoria;
    }
    public function getPromotor()
    {
        return $this->promotor;
    }
    public function setPromotor($promotor)
    {
        $this->promotor = $promotor;
    }
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function setCep($cep)
    {
        $this->cep = $cep;
    }
    public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }
    public function setImagem($imagem)
    {
        $this->imagem = $imagem;
    }
    public function setUf($uf)
    {
        $this->uf = $uf;
    }
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;
    }
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;
    }

    
    } //fim da classe
