<?php

class evaluation 
{
    private ?int $idev;
    private ?string $nom;
    private ?DateTime $deadline;

    // Constructor
    public function __construct(?int $idev, ?string $nom, ?DateTime $deadline, ) {
        $this->idev = $idev;
        $this->nom = $nom;
        $this->deadline = $deadline;
    }

    // Getters and Setters

    public function getIdev(): ?int {
        return $this->idev;
    }
    public function setIdev(?int $idev): void {
        $this->idev = $idev;
    }

    public function getnom(): ?string {
        return $this->nom;
    }

    public function setnom(?string $nom): void {
        $this->title = $nom;
    }

    public function getDeadline(): ?DateTime {
        return $this->deadline;
    }

    public function setDeadline(?DateTime $deadline): void {
        $this->deadline = $deadline;
    }

    
    
    }


?>
