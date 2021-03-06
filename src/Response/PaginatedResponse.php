<?php

namespace BackerClub\IndiegogoApiClient\Response;

use BackerClub\IndiegogoApiClient\AbstractEntity;

abstract class PaginatedResponse extends AbstractEntity
{
    private ?int        $count      = null;
    private ?Pagination $pagination = null;
    protected array     $response;

    abstract public function setResponse(array $response): void;

    abstract public function getResponse(): array;

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    public function getPagination(): ?Pagination
    {
        return $this->pagination;
    }

    public function setPagination(?object $pagination): void
    {
        $this->pagination = $pagination ? new Pagination($pagination) : null;
    }
}
