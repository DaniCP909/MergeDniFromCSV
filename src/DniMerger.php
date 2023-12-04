<?php

namespace Dcorr\MergeDniFromCsv;


class DniMerger {


    private const PATT = '/^\d{8}$/';
    private const PATTNIE = '/^[XYZ]\d{7}$/';
    private const CHECKSUM = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];



    public function isDNIColumn($field): bool
    {
        return 1 === preg_match(self::PATT,$field);
    }

    public function isNIEColumn($field): bool
    {
        return 1 === preg_match(self::PATTNIE,$field);
    }

    public function computeChecksumDNI(string $value): string
    {
        return self::CHECKSUM[$value % 23];
    }

    public function computeChecksumNIE(string $value): string
    {
        return self::CHECKSUM[strtr($value, 'XYZ', '012') % 23];
    }


    public function mergeDni() 
    {

    }

}