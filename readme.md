Техническое задание

1. Создать страницу с формой.
 В форме должны быть следующие поля:   
    - имя
    - email
    - телефон

2. Реализовать отправку этой формы при помощи AJAX.

3. Реализовать обработку AJAX запроса на php.    
    В обработчике нужно:
    - провести валидацию
    - email содержит @
    - телефон
    Эти валидации также продублировать еще на клиенте (js).
    
 2) На поле телефон, должна стоять маска, при нажатии на поле курсор должен ставиться на начало поля (слева)
 
 3) Создать базу данных с полями id name email phone
 
 4) Провести проверку есть ли в этой таблице элемент с заполненным именем емейлом и 
 телефоном, если есть и заявка уходила в период 5 минут, форму не отправлять!

    При успешной проверке - форма должна скрываться, а пользователю должно выводиться сообщение об успешной отправки заявки.
    При неудачной проверке - пользователю должна выводиться ошибка над формой