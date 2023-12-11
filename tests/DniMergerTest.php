<?php

namespace Dcorr\MergeDniFromCsv\Tests;

use PHPUnit\Framework\TestCase;
use Dcorr\MergeDniFromCsv\DniMerger;
use PHPUnit\Framework\Attributes\DataProvider;

final class DniMergerTest extends TestCase
{

    private DniMerger $dniMerger;

    protected function setUp(): void
    {
        $this->dniMerger = new DniMerger();
    }

    public static function dniAndCharProvider() : array
    {
        return [
            ['93726487' => 'S'],
            ['23456789' => 'D'],
            ['45678901' => 'G'],
            ['78901234' => 'X'],
            ['34' => ''],
        ];
    }

    public static function dniAndBooleProvider() : array
    {
        return [
            ['93726487' => true],
            ['08714737' => true],
            ['45678901' => true],
            ['78901234' => true],
            ['34' => false],
        ];
    }

    public function testIsDniValidable() : void
    {
        $this->assertEquals(true, $this->dniMerger->isDniValidable('08714737'));
        $this->assertEquals(true, $this->dniMerger->isDniValidable('93726487'));
        $this->assertEquals(true, $this->dniMerger->isDniValidable('34567890'));
        $this->assertEquals(false, $this->dniMerger->isDniValidable('7890'));
        $this->assertEquals(false, $this->dniMerger->isDniValidable(''));
    }

    public function testIsNieValidable() : void
    {
        $this->assertSame(true, $this->dniMerger->isNieValidable('X3562946'));
        $this->assertSame(true, $this->dniMerger->isNieValidable('Y9265937'));
        $this->assertSame(true, $this->dniMerger->isNieValidable('Z5429456'));
        $this->assertSame(false, $this->dniMerger->isNieValidable('93726487'));
        $this->assertSame(false, $this->dniMerger->isNieValidable(''));
    }

    public function testComputeDni() : void
    {
        $this->assertEquals('D', $this->dniMerger->computeChecksumDNI('23456789'));
        $this->assertEquals('G', $this->dniMerger->computeChecksumDNI('45678901'));
        $this->assertEquals('X', $this->dniMerger->computeChecksumDNI('78901234'));
        $this->assertEquals('', $this->dniMerger->computeChecksumDNI('34'));
    }

}