<?php
use PHPUnit\Framework\TestCase;

final class TrajetTest extends TestCase
{
    public function testGetAvailableReturnsArray()
    {
        $result = \App\Models\Trajet::getAvailable();
        $this->assertIsArray($result);
    }
}
