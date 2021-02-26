<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EventGrpRepository")
 */
class EventGrp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $owner;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_grp;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $id_event;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $picture;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOwner(): ?string
    {
        return $this->owner;
    }

    public function setOwner(string $owner): self
    {
        $this->owner = $owner;

        return $this;
    }

    public function getIdGrp(): ?string
    {
        return $this->id_grp;
    }

    public function setIdGrp(string $id_grp): self
    {
        $this->id_grp = $id_grp;

        return $this;
    }

    public function getIdEvent(): ?string
    {
        return $this->id_event;
    }

    public function setIdEvent(string $id_event): self
    {
        $this->id_event = $id_event;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    public function toArray(){
        return [
            'id' => $this->id, 
            'name' => $this->name, 
            'picture' => $this->picture, 
            'owner'=>$this->owner,
            'id_grp' => $this->id_grp, 
            'id_event' => $this->id_event, 
            'status' => $this->status
        ];
    }
}
