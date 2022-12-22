<?php
declare(strict_types=1);

namespace App;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\Type;
use Doctrine\Deprecations\Deprecation;
use JsonException;

use function is_resource;
use function json_decode;
use function json_encode;
use function stream_get_contents;

use const JSON_PRESERVE_ZERO_FRACTION;
use const JSON_THROW_ON_ERROR;

class MoneyType extends Type
{
    /**
     * !LOOK HERE
     * Constructor is market as final prevent from dependency passing. Which is needed.
     */
    public function __construct(private readonly AmountParser $parser)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getSQLDeclaration(array $column, AbstractPlatform $platform)
    {
        return $platform->getDecimalTypeDeclarationSQL($column);
    }

    /**
     * !LOOK HERE  added $parameters = []
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform, array $parameters = [])
    {
        if (array_key_exists('currency', $parameters)) {
            throw new ConversionException('Money type require access to `currency` to be able to convert it');
        }
        return $this->parser->integerToDecimal($value, $parameters['currency']);
    }

    /**
     * !LOOK HERE added  added $parameters = []
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform, array $parameters = [])
    {
        if (array_key_exists('currency', $parameters)) {
            throw new ConversionException('Money type require access to `currency` to be able to convert it');
        }
        return $this->parser->decimalToInteger($value, $parameters['currency']);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'money';
    }

}
