<?php declare(strict_types=1);

namespace Tests\Model;

use PHPUnit\Framework\TestCase;
use Estudacom\Model\Person;
use Estudacom\Model\House;

final class PersonTest extends TestCase
{
    /**
     * Tests if all() method returns an array of Person instances
     */
    public function testAllReturnsArrayOfPeople(): void
    {
        $people = Person::all();
        
        $this->assertIsArray($people, 'all() method should return an array');
        $this->assertNotEmpty($people, 'The returned array should not be empty');
        $this->assertContainsOnlyInstancesOf(Person::class, $people, 'Array should contain only Person instances');
    }

    /**
     * Tests if find() method returns the correct person when ID exists
     */
    public function testFindReturnsPersonWhenExists(): void
    {
        $person = Person::find(1);
        
        $this->assertInstanceOf(Person::class, $person, 'find() should return a Person instance for a valid ID');
        $this->assertEquals(1, $person->getId(), 'The ID of the returned person should match the requested ID');
        $this->assertEquals('Stannis Baratheon', $person->getName(), "The person's name should be 'Stannis Baratheon'");
        $this->assertEquals(1, $person->getHouseId(), "The person's house_id should be 1");
    }

    /**
     * Tests if find() method returns null when ID does not exist
     */
    public function testFindReturnsNullWhenPersonDoesNotExist(): void
    {
        $this->assertNull(Person::find(999), 'find() should return null for a non-existent ID');
    }

    /**
     * Tests if findByHouseId() method returns the correct people for a given house
     */
    public function testFindByHouseIdReturnsMatchingPeople(): void
    {
        $houseId = 3;
        $people = Person::findByHouseId($houseId);
        
        $this->assertIsArray($people, 'findByHouseId() should return an array');
        $this->assertNotEmpty($people, "There should be people associated with house {$houseId}");
        $this->assertContainsOnlyInstancesOf(Person::class, $people, 'Array should contain only Person instances');
        
        $this->assertEquals($houseId, $people[0]->getHouseId(), "Person should belong to house {$houseId}");
    }
    
    /**
     * Tests if findByHouseId() returns an empty array when house ID does not exist
     */
    public function testFindByNonExistentHouseIdReturnsEmptyArray(): void
    {
        $nonExistentHouseId = 999;
        $people = Person::findByHouseId($nonExistentHouseId);
        
        $this->assertIsArray($people, 'findByHouseId() should return an array even for non-existent house ID');
        $this->assertEmpty($people, 'The result should be an empty array for non-existent house ID');
    }

    /**
     * Tests if house() method returns the correct house associated with the person
     */
    public function testHouseReturnsAssociatedHouse(): void
    {
        $person = Person::find(7);
        $house = $person->house();
        
        $this->assertInstanceOf(House::class, $house, 'house() should return a House instance');
        $this->assertEquals(4, $house->getId(), "The house ID should be 4");
        $this->assertEquals('Stark', $house->getName(), "The house name should be 'Stark'");
        $this->assertEquals($person->getHouseId(), $house->getId(), "The person's house_id should match the house's ID");
    }

    /**
     * Tests if getters return the correct values
     */
    public function testGetters(): void
    {
        $person = Person::find(10); 
        
        $this->assertEquals(10, $person->getId(), 'getId() should return the correct ID');
        $this->assertEquals('Daenerys Targaryen', $person->getName(), 'getName() should return the correct name');
        $this->assertEquals(5, $person->getHouseId(), 'getHouseId() should return the correct house_id');
        
        $this->assertIsInt($person->getId(), 'getId() should return an integer value');
        $this->assertIsInt($person->getHouseId(), 'getHouseId() should return an integer value');
        $this->assertIsString($person->getName(), 'getName() should return a string value');
    }
} 