<?php
mb_internal_encoding('UTF-8');

function normalizeNamePart(string $s): string {
    $s = trim(preg_replace('/\s+/u', ' ', $s));
    return $s === '' ? '' : mb_ucfirst(mb_strtolower($s, 'UTF-8'));
}

$firstName  = 'иван';
$lastName   = 'иванов';
$patronymic = 'иванович';

$firstNameN  = normalizeNamePart($firstName);
$lastNameN   = normalizeNamePart($lastName);
$patronymicN = normalizeNamePart($patronymic);

// Полное имя
$fullName = trim("$lastNameN $firstNameN $patronymicN");

// Фамилия и инициалы
$surnameAndInitials = $lastNameN;
$initials = [];
if ($firstNameN)  $initials[] = mb_substr($firstNameN, 0, 1) . '.';
if ($patronymicN) $initials[] = mb_substr($patronymicN, 0, 1) . '.';
if ($initials) $surnameAndInitials .= ' ' . implode('', $initials);

// Аббревиатура
$fio = '';
if ($lastNameN)  $fio .= mb_substr($lastNameN, 0, 1);
if ($firstNameN) $fio .= mb_substr($firstNameN, 0, 1);
if ($patronymicN) $fio .= mb_substr($patronymicN, 0, 1);
$fio = mb_strtoupper($fio);

echo "Полное имя: $fullName\n";
echo "Фамилия и инициалы: $surnameAndInitials\n";
echo "Аббревиатура: $fio\n";