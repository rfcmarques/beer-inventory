<?php

declare(strict_types=1);

namespace App\DTOs;

final readonly class CountryDTO
{
    public function __construct(
        public string $name,
        public string $officialName,
        public string $code,
        public ?string $capital,
        public string $flagUrl,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            officialName: $data['official_name'],
            code: $data['code'],
            capital: $data['capital'] ?? null,
            flagUrl: $data['flag_url'],
        );
    }

    public static function fromApi(array $data): self
    {
        $arr = [
            'name' => $data['name']['common'],
            'official_name' => $data['name']['official'],
            'code' => $data['cca2'],
            'capital' => $data['capital'][0] ?? null,
            'flag_url' => $data['flags']['svg'] ?? $data['flags']['png'],
        ];

        return self::fromArray($arr);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'official_name' => $this->officialName,
            'code' => $this->code,
            'capital' => $this->capital,
            'flag_url' => $this->flagUrl,
        ];
    }
}