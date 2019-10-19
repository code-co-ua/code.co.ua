<?php

namespace App;

abstract class FakeData
{
    public function generate(int $count = 15): array
    {
        $data = [];

        for ($i = 1; $i <= $count; $i++){
            $data[] = $this->generateItem();
        }

        return $data;
    }

    abstract function generateItem(): object;
}