<?php
class Categoria {

    public function __construct(
        private int $id_categoria = 0,
        private string $descritivo = ""
    ) {}

    public function getID(): int
    {
        return $this->id_categoria;
    }

    public function getDescritivo(): string
    {
        return $this->descritivo;
    }

    public function setDescritivo(string $descritivo): void
    {
        $this->descritivo = $descritivo;
    }

    public function setID(int $id_categoria): void
    {
        $this->id_categoria = $id_categoria;
    }

}
