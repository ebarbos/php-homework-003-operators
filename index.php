<?php
mb_internal_encoding('UTF-8');

function normalizeNamePart(string $s): string {
    $s = trim(preg_replace('/\s+/u', ' ', $s));
    return $s === '' ? '' : mb_convert_case($s, MB_CASE_TITLE, "UTF-8");
}

// Чтение данных от пользователя
$firstName  = readline("Введите имя: ");
$lastName   = readline("Введите фамилию: ");
$patronymic = readline("Введите отчество (если есть, иначе Enter): ");

$firstNameN  = normalizeNamePart($firstName);
$lastNameN   = normalizeNamePart($lastName);
$patronymicN = normalizeNamePart($patronymic);

// Полное имя
$fullName = trim("$lastNameN $firstNameN $patronymicN");

// Фамилия и инициалы
$surnameAndInitials = $lastNameN;
$initials = [];
if ($firstNameN)  $initials[] = mb_substr($firstNameN, 0, 1, "UTF-8") . '.';
if ($patronymicN) $initials[] = mb_substr($patronymicN, 0, 1, "UTF-8") . '.';
if ($initials) $surnameAndInitials .= ' ' . implode('', $initials);

// Аббревиатура
$fio = '';
if ($lastNameN)  $fio .= mb_substr($lastNameN, 0, 1, "UTF-8");
if ($firstNameN) $fio .= mb_substr($firstNameN, 0, 1, "UTF-8");
if ($patronymicN) $fio .= mb_substr($patronymicN, 0, 1, "UTF-8");
$fio = mb_strtoupper($fio, "UTF-8");

echo "Полное имя: $fullName\n";
echo "Фамилия и инициалы: $surnameAndInitials\n";
echo "Аббревиатура: $fio\n";