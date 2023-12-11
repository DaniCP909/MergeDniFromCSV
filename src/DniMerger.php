<?php

namespace Dcorr\MergeDniFromCsv;


class DniMerger {


    private const PATT = '/^\d{8}$/';
    private const PATTNIE = '/^[XYZ]\d{7}$/';
    private const CHECKSUM = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E'];



    public function isDniValidable(string $value): bool
    {
        return 1 === preg_match(self::PATT,$value);
    }

    public function isNieValidable(string $value): bool
    {
        return 1 === preg_match(self::PATTNIE,$value);
    }

    public function computeChecksumDNI(string $value): string
    {
        if(!$this->isDniValidable($value)) {
            return '';
        }
        return self::CHECKSUM[$value % 23];
    }

    public function computeChecksumNIE(string $value): string
    {
        if(!$this->isNieValidable($value)) {
            return '';
        }
        return self::CHECKSUM[strtr($value, 'XYZ', '012') % 23];
    }


}