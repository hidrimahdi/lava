<?php

class MovieModel
{
    private ?int $id = null;
    private ?string $image = null;
    private ?string $name = null;
    private ?string $year = null;
    private ?string $type = null;
    private ?int $rate = null;
    private ?string $tag1 = null;
    private ?string $tag2 = null;
    private ?string $tag3 = null;
    private ?string $description = null;
    private ?int $category_id = null;

    public function __construct(string $image, string $name, string $year, string $type, int $rate, string $tag1, string $tag2, string $tag3, string $description, ?int $category_id)
    {
        $this->image = $image;
        $this->name = $name;
        $this->year = $year;
        $this->type = $type;
        $this->rate = $rate;
        $this->tag1 = $tag1;
        $this->tag2 = $tag2;
        $this->tag3 = $tag3;
        $this->description = $description;
        $this->category_id = $category_id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function getRate(): ?int
    {
        return $this->rate;
    }

    public function getTag1(): ?string
    {
        return $this->tag1;
    }

    public function getTag2(): ?string
    {
        return $this->tag2;
    }

    public function getTag3(): ?string
    {
        return $this->tag3;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }

    public function setTag1(string $tag1): void
    {
        $this->tag1 = $tag1;
    }

    public function setTag2(string $tag2): void
    {
        $this->tag2 = $tag2;
    }

    public function setTag3(string $tag3): void
    {
        $this->tag3 = $tag3;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setCategoryId(?int $category_id): void
    {
        $this->category_id = $category_id;
    }
}