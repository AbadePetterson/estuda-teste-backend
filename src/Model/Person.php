<?php

namespace Estudacom\Model;

use Estudacom\Database;

class Person
{
    private $id;
    private $house_id;
    private $name;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->house_id = $data->house_id;
        $this->name = $data->name;
    }

    /**
     * Load people data from JSON file
     * 
     * @return array|null
     */
    private static function loadData(): ?array
    {
        $database = new Database();
        return $database->readJsonFile(__DIR__ . '/../data/people.json');
    }

    /**
     * Get all people
     * 
     * @return array
     */
    public static function all(): array
    {
        $data = self::loadData();
        
        if (!$data) {
            return [];
        }

        $people = [];
        foreach ($data as $person) {
            $people[] = new self($person);
        }

        return $people;
    }

    /**
     * Find a person by ID
     * 
     * @param int $id
     * @return Person|null
     */
    public static function find(int $id): ?Person
    {
        $data = self::loadData();
        
        if (!$data) {
            return null;
        }

        foreach ($data as $person) {
            if ($person->id === $id) {
                return new self($person);
            }
        }

        return null;
    }

    /**
     * Find people by house ID
     * 
     * @param int $houseId
     * @return array
     */
    public static function findByHouseId(int $houseId): array
    {
        $data = self::loadData();
        
        if (!$data) {
            return [];
        }

        $people = [];
        foreach ($data as $person) {
            if ($person->house_id === $houseId) {
                $people[] = new self($person);
            }
        }

        return $people;
    }

    /**
     * Get the house associated with this person
     * 
     * @return House|null
     */
    public function house(): ?House
    {
        return House::find($this->house_id);
    }

    /**
     * Get person ID
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get house ID
     * 
     * @return int
     */
    public function getHouseId(): int
    {
        return $this->house_id;
    }

    /**
     * Get person name
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
