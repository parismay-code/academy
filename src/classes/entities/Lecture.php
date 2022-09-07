<?php

namespace Academy\classes\entities;

use mysqli;

class Lecture
{
    const STATUS_NEW = 'new';
    const STATUS_SUBMITTED = 'submitted';
    const STATUS_ARCHIVED = 'archived';

    private mysqli $link;
    private int $id;
    private string $title;
    private string $details;
    private string $status;
    private string $creationDate;
    private array $files;

    function __construct(
        mysqli $link,
        int $id,
        string $title,
        string $details,
        string $status,
        string $creationDate,
        array $files
    ) {
        $this->link = $link;
        $this->id = $id;
        $this->title = $title;
        $this->details = $details;
        $this->status = $status;
        $this->creationDate = $creationDate;
        $this->files = $files;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): array|false
    {
        $this->title = $title;

        $sql = "UPDATE lectures SET title = ? WHERE id = ?";

        return dbQuery($this->link, $sql, [$title, $this->id]);
    }

    public function getDetails(): string
    {
        return $this->details;
    }

    public function setDetails(string $details): array|false
    {
        $this->details = $details;

        $sql = "UPDATE lectures SET details = ? WHERE id = ?";

        return dbQuery($this->link, $sql, [$details, $this->id]);
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): array|false
    {
        $this->status = $status;

        $sql = "UPDATE lectures SET status = ? WHERE id = ?";

        return dbQuery($this->link, $sql, [$status, $this->id]);
    }

    public function getCreationDate(): string
    {
        return $this->creationDate;
    }

    public function getFiles(): array
    {
        return $this->files;
    }
}

