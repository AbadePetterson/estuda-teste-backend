<?php

namespace Estudacom\Model;

use Estudacom\Database;

class House
{
    private $id;
    private $name;

    public function __construct($data)
    {
        $this->id = $data->id;
        $this->name = $data->name;
    }

    /**
     * Load houses data from JSON file
     * 
     * @return array|null
     */
    private static function loadData(): ?array
    {
        $database = new Database();
        return $database->readJsonFile(__DIR__ . '/../data/houses.json');
    }

    /**
     * Get all houses
     * 
     * @return array
     */
    public static function all(): array
    {
        $data = self::loadData();
        
        if (!$data) {
            return [];
        }

        $houses = [];
        foreach ($data as $house) {
            $houses[] = new self($house);
        }

        return $houses;
    }

    /**
     * Find a house by ID
     * 
     * @param int $id
     * @return House|null
     */
    public static function find(int $id): ?House
    {
        $data = self::loadData();
        
        if (!$data) {
            return null;
        }

        foreach ($data as $house) {
            if ($house->id === $id) {
                return new self($house);
            }
        }

        return null;
    }

    /**
     * Get all people associated with this house
     * 
     * @return array
     */
    public function people(): array
    {
        return Person::findByHouseId($this->id);
    }
    

    /**
     * Get house ID
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Get house name
     * 
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
