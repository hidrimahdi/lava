<?php

class RatingsModel
{
    private ?int $id = null;
    private ?int $movie_id = null;
    private ?int $user_id = null;
    private ?float $rating = null;

    public function __construct(int $movie_id, int $user_id, float $rating)
    {
        $this->movie_id = $movie_id;
        $this->user_id = $user_id;
        $this->rating = $rating;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieId(): ?int
    {
        return $this->movie_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function getRating(): ?float
    {
        return $this->rating;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setMovieId(int $movie_id): void
    {
        $this->movie_id = $movie_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setRating(float $rating): void
    {
        $this->rating = $rating;
    }
}