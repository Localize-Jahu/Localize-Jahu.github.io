<?php
class Website
{
    public function __construct(
        private int $id_website = 0,
        private string $website = "",
        private $promotor = null
    ) {}

    public function getID(): int
    {
        return $this->id_website;
    }

    public function getUrl(): string
    {
        return $this->website;
    }

    public function setUrl(string $website): void
    {
        $this->website = $website;
    }

    public function setID(int $id_website): void
    {
        $this->id_website = $id_website;
    }

    public function setPromotor(Promotor $promotor): void
    {
        $this->promotor = $promotor;
    }

    public function getPromotor(): Promotor
    {
        return $this->promotor;
    }

}
