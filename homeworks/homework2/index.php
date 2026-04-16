<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #2: Отладка и логирование");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>
<div>
<p>Для реализации логов и записи системных исключений используется один пользовательский класс <code>\App\Debug\Log</code>.</p>
<p>В классе <code>Log</code>:
<ul>
 <li>Функция <code>addLog</code> добавляет сообщение и дату-время в <code>local/logs/log_дата.log</code>.</li>
 <li>Функция <code>write</code> (переопределенная) записывает системные исключения 
    в <code>local/logs/exceptions.log</code>.</li>
</ul>
</p>
<p>В файле <code>local/.settings_extra.php</code> указан пользовательский класс для 
исключений (<code>class_name => \App\Debug\Log</code>).</p>
<p>Для очистки логов <code>local/logs/log_дата.log</code> и <code>local/logs/exceptions.log</code> используется 
функция <code>cleanLog</code> пользовательского класса <code>\App\Debug\Log</code>.</p>

</div>

<hr>

<h4 class="mb-3">Часть 1 - Logger</h4>
<ul class="list-group">
    <li class="list-group-item">
        <a href="/local/logs/log_<?= date("d.m.Y") ?>.log">Файл лога из п1 ДЗ</a>
    </li>
    <li class="list-group-item">
        <a href="writelog.php">Добавление в лог из п1 ДЗ</a>
    </li>
    <li class="list-group-item">
        <a href="clearlog.php">Очистить лог из п1 ДЗ</a>
    </li>
    <li class="list-group-item">
        <a href="/bitrix/admin/fileman_file_edit.php?path=%2Flocal%2FApp%2FDebug%2FLog.php&full_src=Y">
            Файл с классом кастомного логгера
        </a>
    </li>
</ul>


<h4 class="mb-3 mt-5">Часть 2 - Exception</h4>
<ul class="list-group">
    <li class="list-group-item">
        <a href="/local/logs/exceptions.log">Файл лога из п2 ДЗ</a>
    </li>
    <li class="list-group-item">
        <a href="writeexception.php">Добавление в лог из п2 ДЗ</a>
    </li>
    <li class="list-group-item">
        <a href="clearexception.php">Очистить лог из п2 ДЗ</a>
    </li>
    <li class="list-group-item">
        <a href="/bitrix/admin/fileman_file_edit.php?path=%2Flocal%2FApp%2FDebug%2FLog.php&full_src=Y">
            Файл с классом системных исключений
        </a>
    </li>
</ul>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>