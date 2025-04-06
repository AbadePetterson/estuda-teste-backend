<?php declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase;
use Estudacom\Database;

final class DatabaseTest extends TestCase
{
    private $database;
    private $filesPath;

    protected function setUp(): void
    {
        $this->database = new Database();
        $this->filesPath = __DIR__ . '/support/files/';
    }

    public function testReadingValidJsonFile(): void
    {
        $filename = $this->filesPath . 'valid_table.json';
        $data = $this->database->readJsonFile($filename);

        $this->assertEquals(5, count($data));

        foreach ($data as $row) {
            $this->assertObjectHasAttribute('id', $row);
            $this->assertObjectHasAttribute('name', $row);
        }
    }

    public function testReadingInvalidJsonFile(): void
    {
        $filename = $this->filesPath . 'invalid_table.json';
        $this->assertNull($this->database->readJsonFile($filename));
    }

    public function testReadingNotFoundJsonFile(): void
    {
        $filename = $this->filesPath . 'not_found_table.json';
        $this->assertNull($this->database->readJsonFile($filename));
    }
}
