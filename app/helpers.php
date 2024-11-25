<?php

if (!function_exists('formatRupiah')) {
    function formatRupiah($value)
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

        // Menghilangkan angka di belakang koma
        $formatter->setAttribute(NumberFormatter::MAX_FRACTION_DIGITS, 0);

        return $formatter->formatCurrency($value, 'IDR');
    }
}