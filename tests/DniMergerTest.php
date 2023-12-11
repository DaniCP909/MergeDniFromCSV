<?php

namespace Dcorr\MergeDniFromCsv\Tests;

use PHPUnit\Framework\TestCase;
use Dcorr\MergeDniFromCsv\DniMerger;

final class DniMergerTest extends TestCase
{

    private DniMerger $dniMerger;

    protected function setUp(): void
    {
        $this->dniMerger = new DniMerger();
    }

    public function testIsDeniColumn() : void
    {
        $this->assertEquals(true, $this->dniMerger->isDniValidable('08714737'));
        $this->assertEquals(true, $this->dniMerger->isDniValidable('93726487'));
        $this->assertEquals(true, $this->dniMerger->isDniValidable('34567890'));
        $this->assertEquals(false, $this->dniMerger->isDniValidable('7890'));
        $this->assertEquals(false, $this->dniMerger->isDniValidable(''));
    }

    public function testisNieValidable() : void
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