<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("Очистка лога exeption");

?>
<ul class="list-group">
    <li class="list-group-item">
        <a href="/local/logs/exceptions.log">Файл лога exeption</a> очищен
    </li>
</ul>
<?

// ТУТ ДОБАВИТЬ СВОЮ ФУНКЦИЮ ОЧИСТКИ ЛОГА
\App\Debug\Log::cleanLog('exceptions');

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); 
?>