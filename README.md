<h1>Микросервис для счетчиков статистики</h1>
<h1>Установка</h1>
<ol>
<li>
<p>git clone <a href="https://github.com/maximsustavov/kcentr-backend-test.git">https://github.com/maximsustavov/kcentr-backend-test.git</a></p>
</li>
<li>
<p>cd kcentr-backend-test.git</p>
</li>
<li>
<p>composer install</p>
</li>
<li>
<p>измените файл настроек .env</p>
</li>
<li>
<p>php artisan migrate:fresh</p>
</li>
<li>
<p>php artisan serv</p>
</li>
</ol>
<h1>Использование</h1>



<h2>Метод сохранения статистики.</h2>

<p style="color:green;">
method POST <br>
/api/counter/
</p>

Принимает на вход:

date - дата события

views - количество показов

clicks - количество кликов

cost - стоимость кликов (в рублях с точностью до копеек)

Поля views, clicks и cost - опциональные.
Статистика агрегируется по дате.

<br>
<h2>Метод показа статистики</h2>

<p style="color:green;">
method GET <br>
/api/counter/
</p>

Принимает на вход:

from - дата начала периода (включительно)

to - дата окончания периода (включительно)

Отвечает статистикой, отсортированной по дате. В ответе должны быть поля:

date - дата события

views - количество показов

clicks - количество кликов

cost - стоимость кликов

cpc = cost/clicks (средняя стоимость клика)

cpm = cost/views * 1000 (средняя стоимость 1000 показов)

<br>
<h2>Метод сброса статистики</h2>

<p style="color:green;">
method DELETE <br>
/api/counter/
</p>
Удаляет всю сохраненную статистику.
