<?

use Bitrix\Main\Page\Asset;

global $APPLICATION;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php"); ?>
<?php
$APPLICATION->SetTitle("ДЗ #3: Связывание моделей");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
<h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

<h4 class="mb-3">Пояснительная записка</h4>

<div>
	<p>
		Реализован абстрактный класс <code>AbstractIblockPropertyValuesTable</code> 
		с методом получения ID инфоблока по его символьному коду (нужен при использовании старого API).<br>
		В дочерних классах <code>MedicPropertyValuesTable</code> и <code>ProcPropertyValuesTable</code>
		реализованы основные методы для работы с инфоблоками. 
	</p>
	<p>
		В формах добавил биртиксовую защиту сессий:
		<ul>
			<li><code>check_bitrix_sessid()</code>,</li>
			<li><code>bitrix_sessid_post()</code>,</li>
			<li><code>htmlspecialcharsbx()</code>.</li>
		</ul>
	</p>
</div>

<h4 class="mb-3">Файлы проекта</h4>

<div>
	<ul class="list-group">
    	<li class="list-group-item">
        	<a href="doctors/">Список врачей</a>
    	</li>
    	<li class="list-group-item">
        	<a href="doctors/new.php">Добавление врача</a>
    	</li>
    	<li class="list-group-item">
        	<a href="doctors/newproc.php">Добавление процедуры</a>
		</li>
		<li class="list-group-item">
			Переход на страницу редактирования врача из <a href="doctors/">списка врачей</a>
		</li>
	</ul>
</div>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>