<?php
declare(strict_types=1);
namespace App;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Embeddable;

#[Embeddable]
class Money
{
    public function __construct(
        #[Column(type: 'string')]
        public readonly string $currency,
        #[Column(type: 'string')]
        public readonly string $amount
    ) {
    }
}