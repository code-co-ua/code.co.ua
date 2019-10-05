<?php

function parsedown(string $text): string
{
    return app('parsedown')->text($text);
}