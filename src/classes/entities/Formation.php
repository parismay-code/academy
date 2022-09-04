<?php

namespace Academy\classes\entities;

class Formation
{
    private string $name;
    private string $leaderName;
    private string $deputyLeaderName;
    private string $lawyerName;

    function __construct(string $name, string $leaderName, string $deputyLeaderName, string $lawyerName)
    {
        $this->name = $name;
        $this->leaderName = $leaderName;
        $this->deputyLeaderName = $deputyLeaderName;
        $this->lawyerName = $lawyerName;
    }

    public function getFormationName(): string
    {
        return $this->name;
    }

    public function getLeaderName(): string
    {
        return $this->leaderName;
    }

    public function getDeputyLeaderName(): string
    {
        return $this->deputyLeaderName;
    }

    public function getLawyerName(): string
    {
        return $this->lawyerName;
    }
}
