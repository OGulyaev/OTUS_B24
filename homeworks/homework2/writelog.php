<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Добавление в лог");

?>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="/local/logs/log_<?= date("d.m.Y") ?>.log">Файл лога</a>,
            в лог добавленно 'Page writelog.php is open'
        </li>
    </ul>
<?
// ТУТ ДОБАВИТЬ СВОЮ ФУНКЦИЮ ДОБАВЛЕНИЯ В ЛОГ
/* 1. Использовал имеющийся в примере класс Log и функцию addLog для записи сообщения в файл лога 
   2. в функции addLog исправил адрес создаваемого файла лога на log_custom.log (как на странице ДЗ) */

\App\Debug\Log::addLog('Page writelog.php is open');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); 
?>