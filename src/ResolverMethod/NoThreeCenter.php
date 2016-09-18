<?php

namespace Davaxi\Takuzu\ResolverMethod;

use Davaxi\Takuzu\Grid;
use Davaxi\Takuzu\GridHelpers;
use Davaxi\Takuzu\ResolverMethod;

/**
 * Class NoThreeCenter
 * @package Davaxi\Takuzu\ResolverMethod
 */
class NoThreeCenter extends ResolverMethod
{
    const METHOD_NAME = 'NoThreeCenter';

    /**
     * @var integer
     */
    protected $foundedWay;

    /**
     * @param array $line
     * @return boolean
     */
    protected function foundOnGridLine(array $line)
    {
        $positions = GridHelpers::getUndefinedLinePositions($line);
        foreach ($positions as $position) {
            if (static::checkLineRange($line, $position)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param array $line
     * @param $position
     * @return bool
     */
    protected function checkLineRange(array $line, $position)
    {
        $beforePosition = $position - 1;
        if (!isset($line[$beforePosition])) {
            return false;
        }
        $afterPosition = $position + 1;
        if (!isset($line[$afterPosition])) {
            return false;
        }
        if ($line[$beforePosition] !== $line[$afterPosition]) {
            return false;
        }
        if ($line[$beforePosition] === Grid::UNDEFINED) {
            return false;
        }
        $this->foundedValues[$position] = GridHelpers::getReverseValue($line[$beforePosition]);
        return true;
    }

}