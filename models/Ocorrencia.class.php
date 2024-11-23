<?php
class Ocorrencia{
    public function __construct(
        private int $id_ocorrencia = 0,
        private string $dia = "",
        private string $horaInicio = "",
        private string $horaTermino = "",
        private $evento = null
    ){}

    public function getID(): int
    {
        return $this->id_ocorrencia;
    }

    public function setID(int $id_ocorrencia): void
    {
        $this->id_ocorrencia = $id_ocorrencia;
    }

    public function getDia(): string
    {
        return $this->dia;
    }

    public function setDia(string $dia): void
    {
        $this->dia = $dia;
    }

    public function getHoraInicio(): string
    {
        return $this->horaInicio;
    }

    public function setHoraInicio(string $horaInicio): void
    {
        $this->horaInicio = $horaInicio;
    }

    public function getHoraTermino(): string
    {
        return $this->horaTermino;
    }

    public function setHoraTermino(string $horaTermino): void
    {
        $this->horaTermino = $horaTermino;
    }

    public function getEvento() : Evento
    {
        return $this->evento;
    }

    public function setEvento(Evento $evento)
    {
        $this->evento = $evento;
    }
    
}