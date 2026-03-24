<?php

declare(strict_types=1);

function renderView(string $template, array $data = []): void
{
    // แปลง array ให้เป็นตัวแปรใน template
    extract($data);

    include TEMPLATES_DIR . '/' . $template . '.php';
}