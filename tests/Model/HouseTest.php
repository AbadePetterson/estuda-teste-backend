<?php declare(strict_types=1);

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use Estudacom\Model\House;
use Estudacom\Model\Person;

final class HouseTest extends TestCase
{
    /**
     * Tests if all() method returns an array of House instances
     */
    public function testAllReturnsArrayOfHouses(): void
    {
        $houses = House::all();
        
        $this->assertIsArray($houses, 'all() method should return an array');
        $this->assertNotEmpty($houses, 'The returned array should not be empty');
        $this->assertContainsOnlyInstancesOf(House::class, $houses, 'Array should contain only House instances');
    }

    /**
     * Tests if find() method returns the correct house when ID exists
     */
    public function testFindReturnsHouseWhenExists(): void
    {
        $house = House::find(1);
        
        $this->assertInstanceOf(House::class, $house, 'find() should return a House instance for a valid ID');
        $this->assertEquals(1, $house->getId(), 'The ID of the returned house should match the requested ID');
        $this->assertEquals('Baratheon', $house->getName(), 'The house name should be Baratheon');
    }

    /**
     * Tests if find() method returns null when ID does not exist
     */
    public function testFindReturnsNullWhenHouseDoesNotExist(): void
    {
        $this->assertNull(House::find(999), 'find() should return null for a non-existent ID');
    }

    /**
     * Tests if people() method returns the people associated with the house
     */
    public function testPeopleReturnsAssociatedPeople(): void
    {
        $houseId = 4;
        $house = House::find($houseId);
        $people = $house->people();
        
        $this->assertIsArray($people, 'people() method should return an array');
        $this->assertNotEmpty($people, 'The people array should not be empty');
        $this->assertContainsOnlyInstancesOf(Person::class, $people, 'Array should contain only Person instances');
        
        $randomPerson = $people[0];
        $this->assertEquals($houseId, $randomPerson->getHouseId(), 'People should belong to the house');
    }

    /**
     * Tests if getters return the correct values
     */
    public function testGetters(): void
    {
        $house = House::find(3);
        
        $this->assertEquals(3, $house->getId(), 'getId() should return the correct ID');
        $this->assertEquals('Lannister', $house->getName(), 'getName() should return the correct name');
        $this->assertIsInt($house->getId(), 'getId() should return an integer value');
        $this->assertIsString($house->getName(), 'getName() should return a string value');
    }
} 