<?php

function price($value)
{
    return 'R$' . number_format($value, 2, ',', '.');
}

function selected($value)
{
    return $value ? 'selected' : '';
}
