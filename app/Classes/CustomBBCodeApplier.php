<?php

namespace App\Classes;

use Genert\BBCode\BBCode;

class CustomBBCodeApplier
{
    /**
     * @param BBCode $bbCode
     */
    private static function applyCustomCodes(BBCode $bbCode):void
    {
        $bbCode->addParser(
            'center',
            '/\[center\](.*?)\[\/center\]/s',
            '<center>$1</center>',
            '$1'
        );

        $bbCode->addParser(
            'sea',
            '/\[sea\](.*?)\[\/sea\]/s',
            '<span style="color: #171A97">$1</span>',
            '$1'
        );

        $bbCode->addParser(
            'colleft',
            '/\[colleft\](.*?)\[\/colleft\]/s',
            '<div class="colleft">$1</div>',
            '$1'
        );

        $bbCode->addParser(
            'right',
            '/\[right\](.*?)\[\/right\]/s',
            '<div style="text-align:right;">$1</div>',
            '$1'
        );
    }

    /**
     * @param string $entity
     * @return string
     */
    public static function apply(string $entity)
    {
        $bbCodeEntity = new BBCode();

        self::applyCustomCodes($bbCodeEntity);

        return $bbCodeEntity->convertToHtml($entity);
    }
}
