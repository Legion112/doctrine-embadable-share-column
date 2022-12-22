<?php

declare(strict_types=1);

namespace App;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'operation')]
class Operation
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column]
        public readonly int $id,
        #[ORM\Embedded]
        public readonly Money $total,
    ) {

    }

}