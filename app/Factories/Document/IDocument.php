<?php

declare(strict_types=1);

namespace App\Factories\Document;

interface IDocument
{
    public function process(array $data);
}
