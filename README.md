# LRS_Project


LRS Project
by ImageSpark<br>

# Структура проекта

В корневом каталоге LRS_Project находятся несколько подкаталогов app, js, css, img
 - подкаталог app содержит основной модуль приложения
 - подкаталог css содержит все общедоступные CSS-файлы;
 - подкаталог js хранит общедоступные JavaScript-файлы;
    
 * public/
     * scs
     * js
 * app/
     * controllers/
     * core/
     * lib/
     * models/
     * views/
         * layouts/

  
Директория app содержит подкаталоги config, controllers, core, lib, models, views
 - подкаталог config содержит вспомогательныу файлы для отладки ошибок и осуществления миграции базы данных
 - подкаталог controllers содержит все контроллеры
 - подкаталог core содержит родительские классы Model, View, Controller
 - подкаталог lib содержит файлы подключаемых библиотек
 - подкаталог models содержит все необходимые модели
 - подкаталог views содержит все необходимые представления

=======
# Миграции и база данных
1.Прописать в файле app/config/Database.php данные для подключения к базе данных.
2.Для осуществения миграции необходимо в index.php прописать $migration = MigrationController::migrationAction(); тем самым вызвать метод migrationAction.

База данных LRS.

Таблица users - Содержит данные о пользователе
id - id Пользователя,primary key
login - Логин пользователя
password - Пароль пользователя
name - Имя пользователя
email - Email пользователя


Таблица lrs - Содержит названия курсов обучения и их описание.
id - id Курса,primary key
name -  Название курса
description - Описание курса


Таблица lrs_client - Клиенты LRS
id - id клиента курса, primary key
lrs_id - id курса
login - Логин клиента курса
password - пароль клиента
description - ФИО пользователя 


Таблица lrs_statements - Хранятся все учебные события.
id - id утверждения (события), primary key 
irs id - id курса
lrs_client_id - id клиента
actor - актер
verb - дейстие
activity - задача
content - содержимое 

Таблица lrs_state - Данные по ключам.
id - id state, primary key
lrs id - id lrs
lrs client id - id клиента
state_key 
value - значение
activity - задача
registration

<img src="i.imgur.com/bCaxi38.png">

# Компонент Router

Содержит 2 публичных свойства и метода.

Первое свойство $params = [] - хранит данные, какой вызвать контроллер и экшн
Второе свойство $argUri = [] - хранит аргументы (гет запроса)

Метод __construct()
$routesList - хранит список роутов из app/config/Routes.php
$routeUri - хранит преобразованную строку 'controller/action'

Записывает в $argUri аргументы гет запроса.

Устанавливает булеву переменную $foundRoute в false, для последующей проверки в цикле

Циклом проходит по списку роутов и ищет совпадение с проеобразованной строкой.
Если строка найдена, устанвливает $foundRoute = true и вызывает второй метод Run 
Если совпадение не найдено, задает $foundRoute = false
После выхода из цикла следует проверка $foundRoute
если она равна false, то пользователь перенаправляется на страницу с ошибкой 404.

Метод run
$path - содержит путь до контроллера, который нужно вызвать
Алгоритм:
<ul>
	<li>1. Поиск класса по заданному пути</li>
	<li>1.1 Если класс отсутвует, пользователю сообщается "Class not found: название класса </li>
	<li>2. $controller = компоненту Controller</li>
	<li>3. $action = название экшна, которое необходимо вызвать</li>
	<li>4. Проверка на наличие экшна в контроллере</li>
	<li>4.1 Если экшн отсутсвует, пользователю сообщается "Action not found: название экшна"</li>
	<li>5. Проверка на наличие аргументов гет запроса</li>
	<li>5.1 Если аргументов нет, то вызывает метод контроллера без параметров</li>
	<li>5.2 При наличии каких-либо аргументов, вызывает метод контроллера и в качестве параметра передает массив с аргументами</li>
</ul>

# Компонент контроллер
1. Класс Controller - данный класс является родителем для всех контроллеров, используемых в программе. В него вынесены все основные функции, дублирующиеся в потомках.
Используемые параметры:
- $model, $view - подключаемые модели и вью соответственно
- $route - путь, принимаемый из роутера и используемый в качестве автоподключения модели и вью

<ul style='list-style-type: none;'>
    <li>1.1 public beforeAction() - Функция-фильтр контроля доступа, которая может проверять аутентификацию пользователя перед тем, как будет выполнено запрошенное действие.</li>
    <li>1.2 public function __construct($route) - Функция принимает в качестве параметра путь, задаваемый в роутере передаёт путь роутера в глобальную переменную для дальнейшей передачи контроллерам-потомкам.</li>
    <li>1.3 private function getModel($nameModel) - Функция автоподключения модели.</li>
    <li>1.4 public function migrationAction() - Функция для выполнения миграции БД.</li>
    <li>1.5 public function listAction() - Функция получения списка из базы данных. В функции по умолчанию задаётся количество страниц равное нулю, что является сигналом для вывода всех записей из заданной таблицы на экран. Если количество страниц задано явно, то выводятся строки в определённом диапазоне. Здесь же происходит проверка запроса на sql-инъекции. В качестве результата ожидается массив с данными БД.</li>
    <li>1.6 public function addAction() - Функция добавления в базу данных. В качестве передаваемых далее параметров рассматривается неограниченный по размеру GET-массив. Массив GET проверяется на наличие каких-либо параметров для внесения в sql-таблицу, поэтому значение параметров должно быть больше единицы (поскольку добавление рассматривается как универсальная функция). Первым действием из него извлекается и удаляется часть, ответственная за путь роутера. Затем происходит проверка на sql-инъекции, полученные параметры передаются в модель. В качестве результата ожидается массив с записью об успешности/провале произведённой операции.</li>
    <li>1.7 public function deleteAction() - Функция удаления из базы данных. В качестве передаваемого в модель параметра рассматривается id, проверяется на наличие инъекций и отправляется в модель. В качестве результата ожидается массив с записью об успешности/провале произведённой операции.</li>
    <li>1.8 public function editgetAction() - Функция получения редактируемых данных из базы данных. В качестве передаваемого в модель параметра рассматривается id, проверяется на наличие инъекций и отправляется в модель. В качестве результата ожидается массив, содержащий данные редактируемого пользователя.</li>
    <li>1.9 public function editputAction() - Функция обновления информации в базе данных. В качестве параметров, передаваемых в модель, рассматриваются GET-массив, из которого удаляется часть, связанная с путём из роутера, отдельно извлекается id изменяемой записи, а остальные параметры передаются в качестве данных, которые необходимо изменить. В качестве результата ожидается массив с записью об успешности/провале произведённой операции.</li>
    <li>1.10 public function convertToJson($array) - Функция конвертирования полученного из модели ответа в json-массив. Так как модель не работает непосредственно с данными, то она возвращает только массив в определённом формате, а все его преобразования выполняются уже в контроллере.</li>
    <li>1.11 public function redirect($url) - Функция возвращает переход на другую страницу без отправки заголовков.</li>
</ul>
2. Контроллеры-потомки содержат либо уникальные действия для каждого случая, либо информацию, необходимую классу Controller для функционирования (например, название таблицы). Также в них происходит подключение моделей и вью, необходимых для конкретного случая.
<ul style='list-style-type: none;'>
    <li>2.1 MigrationController - используется для работы с миграциями, содержит метод migrationAction().</li>
    <li>2.2 LrsController</li>
    <li>2.3 LrsClientController</li>
    <li>2.4 LrsStateController</li>
    <li>2.5 LrsStatementsController</li>
    <li>2.6 UserController</li>
</ul>

# Компонент View

Создается вызовом в родительском контроллере метода getInstance().
Если компонент уже был создан, при последующих вызовах getInstance() будет возвращен один и тот же обьект.

Компонент имеет метод setLayout($layout) принимающий название макета (находящийся по следующему пути '/app/views/layouts/') в виде строки без расширения.
Метод redirect($url) принимает строку. Используется для перенаправления пользователя после совершения какого-либо действия (создания пользователя, редактирование, прохождение курса).

Метод generate($template, $vars = []) принимает путь до UI, в качестве строки и массив данных(необязательно).
Формат данных:
<ul style='list-style-type: none;'>
    <li>3.1 $template - строка</li>
    <li>3.1.1 'папка/файл' без расширения</li>
    <li>3.1.2 Пример: generate('user/index') /app/views/user/index.php</li>
    <li>Принцип работы метода: </li>
    <li>3.2 Проверяет наличие подключаемого макета (заданного методом setLayout($layout))</li>
    <li>3.3 Создает переменные и присваивает им значения из массива $vars[] по принципу $key => $value, вызывая функцию extract($vars)</li>
    <li>3.3.1 Массив vars[] должен быть подготовлен в контроллере и передан в метод generate($title, $vars = [])</li>
    <li>3.3.2 Пример использования vars = ['title' => 'Main page']</li>
    <li>3.4 Проверяет наличие файла, отображающего интерфейс, переданного в качестве первого параметра метода generate($template)</li>
    <li>3.4.1 Если файл присутствует, подключает его</li>
    <li>3.4.2 Если файл отсутствует, выдает соответствующее сообщение пользователю</li>
    <li>3.5 Подключает макет, с которым подтягиваются интерфейс и данные</li>
</ul>

По пути app/views/layouts/main.php находится основной шаблон проекта. При наличии установленной переменной в массиве $_POST['errors'], над всем контентом в отдельном блоке выводятся сообщения об ошибках. Чтобы заполнить массив, при написании скрипта валидации, заполнять массив следующим способом: $_POST['errors'][] = 'about error'.


# Компонент Model 
Кдасс Model является родителем для всех имеющихся моделей и должен выступать в последствии в качестве предка для всех новых создаваемых моделей.
Класс Model осуществляет подключение к базе данных через вызов метода get_instance класса DataBase<br>
В классе Model так же присутствуют функции построения SQL запросов вставки и редактирования.<br><br>
Функция ***buildInsertSql()***<br>
В качестве ***входных параметров*** принимает:
   * ассоциативный массив<br>
('name'=>'Пушкин Александр Сергеевич','email'=>'skazshikadyadyavednedarom@mail.ru'),<br>
в котором ключами являются названия полей таблицы в базе данных, а значениями данные, которые необходимо вставить в каждое поле;<br>
   * название таблицы в формате строки; <br>
   
 ***Возвращает строку*** с готовым сгенерированным SQL запросом, который можно запустить на выполнение.<br><br>

Функция ***buildUpdateSql()***<br>
В качестве ***входных параметров*** принимает:
   * ассоциативный массив<br>
('name' => 'Тютчев Федор Иванович', 'email' => 'yaochiznal@mail.ru'),<br>
в котором так же ключами являются названия полей таблицы в базе данных, а значениями данные, которые необходимо обновить<br>
   * название таблицы, в которой необходимо произвести изменение, в формате строки<br>
   * идентификатор обновляемой записи<br>
      
***Возвращает строку*** с готовым сгенерированным SQL запросом, который можно запустить на выполнение.<br><br>

Функция ***getFields()***<br>
Выводит названия полей таблицы
В качестве ***входных параметров*** принимает:<br>
   * название таблицы в формате строки;<br>
      
***Возвращает ассоциативный массив*** , содержащий ключ 'str' , значением которого является строка с перечнем полей таблицы,
ключ 'array', значением которого выступает массив с этими полями.<br><br>

Функция ***getAllRecords()***<br>
В качестве ***входных параметров*** принимает:
   * список полей таблицы (в формате строки), по которым необходимо вывести все данные<br>
      
***Возвращает строку*** массив с массивами вида:<br>
[0]=>Array<br>
('name' => 'Пушкин Александр Сергеевич','email'=>'skazshikadyadyavednedarom@mail.ru', 'phone'=>'8908367382')<br>
[1]=>Array<br>
('name' => 'Тютчев Федор Иванович', 'email' => 'yaochiznal@mail.ru', 'phone'=>'89084589300')<br>
<br><br>


Функция ***Select()***<br>
Извлекает из таблицы запись, по определенному условию<br>
В качестве ***входных параметров*** принимает:<br>
   *  предикатор, условие которому соответствует запись<br>
   *  список полей таблицы (в формате строки), по которым необходимо вывести все данные<br>
 
      
***Возвращает ассоциативный массив*** вида:<br>
Array(
'name' => 'Тютчев Федор Иванович', 'email' => 'yaochiznal@mail.ru', 'phone'=>'89084589300')
<br><br>

Функция ***getValue()***<br>
Возвращает значение элемента массива по введенному ключу<br>
***Работает только в тандеме с функцией Select()!!!***<br>
В качестве ***входных параметров*** принимает:<br>
   * ключ (в формате строки) значения, которое необходимо получить<br><br>
***Возвращает значение поля по ключу***<br><br>

Функция ***setValue()***<br>
Записывает полученное значение в массив с измененными данными(changed_params)<br>
В качестве ***входных параметров*** принимает:<br>
   * ключ (в формате строки) значения, которое необходимо изменить<br>
   * обновленное значение <br>
      
***Возвращает измененный ассоциативный массив*** вида:<br>
Array(
'name' => 'Цветаева Марина Ивановна')
<br><br>
Функция ***setValues()***<br>
Записывает полученные значения в массив с измененными данными(changed_params)<br>
В качестве ***входных параметров*** принимает:<br><br>
   
   массив измененных данных
      
***Возвращает измененный ассоциативный массив*** вида:<br>
Array(
'name' => 'Цветаева Марина Ивановна', 'email' => 'mnenravitza@mail.ru', 'phone'=>'89084589300')
<br><br>

Функция ***updateRecord()***<br>
Функция выполняет обновление данных в бд, получая значения для обновления из массива changed_params<br>
В качестве ***входных параметров*** принимает:<br><br>
   идентификатор изменяемой записи<br>
<br><br>
Функция ***addRecord()***<br>
Функция выполняет вставку данных в бд, получая значения для обновления из массива changed_params<br>
<br><br>
 Функция ***dropRecord()***<br>
Функция выполняет удаление записи из таблицы в бд по идентификатору<br>
В качестве ***входных параметров*** принимает:<br><br>
   идентификатор удаляемой записи<br>
<br><br>
