<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Очистка лога");
?>
    <ul class="list-group">
        <li class="list-group-item">
            <a href="/local/logs/log_<?= date("d.m.Y") ?>.log">Файл лога</a> очищен
        </li>
    </ul>
<?
// ФУНКЦИЯ ОЧИСТКИ ЛОГА

\App\Debug\Log::cleanLog('log_' . date("d.m.Y"));

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>