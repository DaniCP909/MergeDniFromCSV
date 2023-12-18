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

    public static function dniAndBoolProvider() : array
    {
        return [
            ['93726487', true],
            ['08714737' , true],
            ['45678901' , true],
            ['78901234' , true],
            ['34' , false],
        ];
    }

    public static function nieAndBoolProvider() : array
    {
        return [
            ['X3562946', true],
            ['Y9265937' , true],
            ['Z5429456' , true],
            ['78901234' , false],
            ['34' , false],
        ];
    }

    public static function dniAndCharProvider() : array
    {
        return [
            ['93726487' , 'S'],
            ['23456789' , 'D'],
            ['45678901' , 'G'],
            ['78901234' , 'X'],
            ['34' , ''],
        ];
    }


    public static function nieAndCharProvider() : array
    {
        return [
            ['X3562946' , 'Q'],
            ['Y9265937' , 'X'],
            ['Z5429456' , 'N'],
            ['78901234' , ''],
            ['34' , ''],
        ];
    }

    #[DataProvider('dniAndBoolProvider')]
    public function testIsDniValidable(string $input, bool $expected) : void
    {
        $this->assertSame($expected, $this->dniMerger->isDniValidable($input));
    }

    #[DataProvider('nieAndBoolProvider')]
    public function testIsNieValidable(string $input, bool $expected) : void
    {
        $this->assertSame($expected, $this->dniMerger->isNieValidable($input));
    }

    #[DataProvider('dniAndCharProvider')]
    public function testComputeDni(string $input, string $expected) : void
    {
        $this->assertEquals($expected, $this->dniMerger->computeChecksumDNI($input));
    }

    #[DataProvider('nieAndCharProvider')]
    public function testComputeNie(string $input, string $expected) : void
    {
        $this->assertEquals($expected, $this->dniMerger->computeChecksumNIE($input));
    }

}