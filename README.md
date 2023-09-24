# <p align="center"> Цифрвовой прорыв: сезон ИИ </p>
## <p align="center"> Кейс: Распознавание дефектов дорожного покрытия </p>
<p align="center">
<img width="743" alt="photo" src="https://github.com/VoLuIcHiK/road-defects/assets/90902903/cfc105ad-56e5-436d-84d8-0b5cbad06709">
</p>


*Состав команды "нейрON"*   
*Чиженко Леон (https://github.com/Leon200211) - Fullstack-разработчик*    
*Сергей Куликов (https://github.com/MrMarvel) - Backend-разработчик*  
*Карпов Даниил (https://github.com/Free4ky) - ML-engineer*  
*Валуева Анастасия (https://github.com/VoLuIcHiK) - ML-engineer/Designer*   
*Козлов Михаил (https://github.com/Borntowarn) - ML-engineer*  

## Оглавление
1. [Задание](#1)
2. [Решение](#2)
3. [Результат разработки](#3)
4. [Уникальность нашего решения](#5)
5. [Стек](#6)
6. [Запуск](#7)
7. [Ссылки](#9)

## <a name="1"> Задание </a>

На основе данных видеопотока, данных с лидаров, с акселерометров распознавать трещины, ямы, «заплатки» на асфальтовом покрытии, а также взаимосвязывать найденные дефекты с данными геолокации - в виде отрисованной карты дефектов территории с обозначением типов дефектов. Для отрисовки возможно использование как симуляционной среды, представленной участникам компанией «Меркатор Холдинг», так и самостоятельной реализации на любом удобном для команды фреймворке.

## <a name="2">Решение </a>

Ниже представлен алгоритм работы ML-части нашего приложения: 
<p align="center">
<img width="600" height="400" alt="image" src="https://github.com/VoLuIcHiK/road-defects/assets/90902903/0831577f-229d-48ff-b875-e1dd45bbf739">
</p>
Схема базы данных: 
<p align="center">
<img width="600" height="400" alt="image" src="https://github.com/VoLuIcHiK/road-defects/assets/90902903/600c15de-0440-43d3-bd10-1799919c1b65">
</p>
Изображение в наборе данных: 
<p align="center">
<img width="600" height="400" alt="image" src="https://github.com/VoLuIcHiK/road-defects/assets/90902903/ededb1e9-ee68-4505-88e8-0ca9eaabb352">
</p>
Обнаруженные на нем ямы: 
<p align="center">
<img width="600" height="400" alt="image" src="https://github.com/VoLuIcHiK/road-defects/assets/90902903/a2ad96cb-bbd0-4cc4-b8fc-e71c9ce1362f">
</p>

## <a name="3">Результат разработки </a>

В ходе решения поставленной задачи нам удалось разработать веб-сервис со следующими возможностями:
1. Фильтрация дефектов по классам и дате обнаружения;
2. Анализ результатов обработки файла (отображение графиков);
3. Возможность выбора типа карты;
4. Загрузка данных на сайте в формате .db3 (в разработке).

Также была реализована программы для детекции ям с помощью данных лидара, база данных для хранения информации (класс дефекта, его координаты и дата обнаружения/обновления), программа для распознавания дефектов дорожного покрытия (выбоина, аллигаторная трещина, поперечная трещина, продольная трещина) на основе видеопотока. 



## <a name="5">Уникальность нашего решения </a>
- Распознавание ям происходит с помощью данных лидара;
- Отсуствия тяжелых нейронных сетей для распознавания ям (использование математических операций и алгоритма кластеризации DBSCAN);
- Кросс-платформенный сервис;
- Подходит любая ОС, которая поддерживает docker (упаковали решение в docker-контейнеры)
- Дополнительно: наличии нейронной сети для распознавания ям по видеопотоку (веса для YOLOv8 лежат на гугл-диске).


## <a name="6">Стек </a>
<div>
  <img src="https://github.com/devicons/devicon/blob/master/icons/python/python-original-wordmark.svg" title="Python" alt="Puthon" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/css3/css3-plain-wordmark.svg" title="css" alt="css" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/javascript/javascript-original.svg" title="js" alt="js" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/html5/html5-original-wordmark.svg" title="html" alt="html" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/php/php-original.svg" title="php" alt="php" width="40" height="40"/>&nbsp;
  <img src="https://github.com/devicons/devicon/blob/master/icons/docker/docker-original-wordmark.svg" title="docker" alt="docker" width="40" height="40"/>&nbsp;

## <a name="7">Запуск </a>

Первый запуск может занимать 10 минут и более.

Для запуска сервиса загрузки:
1. Склонировать репозиторий `git clone`
2. В папке проекта выполнить команду `docker-compose up`
3. Зайти на `127.0.0.1:7860`.
4. Загрузить .db3 файл.
5. Нажать обработать

Для просмотра результата можно зайти на сайт:
1. Зайти на сайт ["Дорожный контроль"](http://u1988986.isp.regruhosting.ru/);
2. Посмотреть результат работы программы, отображенный на карте.


## <a name="9">Ссылки</a>
- [Ссылка на наш сайт "Дорожный контроль"](http://u1988986.isp.regruhosting.ru/)
- [Гугл диск с материалами](https://drive.google.com/drive/u/0/folders/1kpDulDps4xzH_tF3F8Zxzf_Mqz_BsiFG)



