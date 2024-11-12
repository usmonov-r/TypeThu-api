<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TestResultRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection ;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Put;
use App\Controller\TestCalculateController;

#[ORM\Entity(repositoryClass: TestResultRepository::class)]
#[ApiResource( 
     operations: [
        new Post(
            uriTemplate: 'post-result',
            controller: TestCalculateController:: class,
            name: 'TestCalculateController'
        ),
        new Get(),
        new GetCollection(),
        new Delete(),
        new Put(),
    ],
    normalizationContext: ['groups' => ['result:read']],
    denormalizationContext: ['groups' => ['result:write']]

)
]
#[Groups(['result:read'])]
class TestResult
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = 1;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['result:write'])]
    private ?string $inputText = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['result:write'])]
    private ?int $duration = null;

    #[ORM\Column]
    private ?float $accuracy = null;

    #[ORM\Column]
    private ?int $wpm = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['result:write'])]
    private ?TextSnippet $textSnippet = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['result:write'])]
    private ?int $incorrectChar = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInputText(): ?string
    {
        return $this->inputText;
    }

    public function setInputText(?string $inputText): static
    {
        $this->inputText = $inputText;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getAccuracy(): ?float
    {
        return round($this->accuracy);
    }

    public function setAccuracy(float $accuracy): static
    {
        $this->accuracy = $accuracy;

        return $this;
    }

    public function getWpm(): ?int
    {
        return $this->wpm;
    }

    public function setWpm(int $wpm): static
    {
        $this->wpm = $wpm;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTextSnippet(): ?TextSnippet
    {
        return $this->textSnippet;
    }

    public function setTextSnippet(?TextSnippet $textSnippet): static
    {
        $this->textSnippet = $textSnippet;

        return $this;
    }

    public function getIncorrectChar(): ?int
    {
        return $this->incorrectChar;
    }

    public function setIncorrectChar(?int $incorrectChar): static
    {
        $this->incorrectChar = $incorrectChar;

        return $this;
    }
}
