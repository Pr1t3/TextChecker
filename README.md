# Тестовое задание
## Предметное описание
Латинские символы (A, E, O, P, X и тд.) похожи на кириллицу и наоборот.
Приложение должно находить и подсвечивать символы, которые не соответствуют языку введенной строки. Основные языки: русский и английский.
Определение языка происходит путем подсчета количества символов. При одинаковом количестве символов в приоритете русский язык. 


## Пример
Пользователь вводит в форму строку: «Для aктивации аккaунта неoбxодимо ввeсти код подтвеpждения». Строка в примере содержит латинские символы, они выделены жирным шрифтом. Нажав на кнопку проверки определяется язык строки и подсвечиваются символы, которые ему не соответствуют. Строка сохраняется в истории использования. После исправления найденных символов на правильные, в данном случае на кириллицу, повторная проверка запускается автоматически.

## Техническое задание
Ориентируясь на предметное описание и пример, создайте форму, позволяющую вводить текст произвольной длины и отображать результат проверки по нажатию на кнопку проверки. Если пользователь исправляет найденные символы после их подсветки, повторную проверку запускать автоматически, без нажатия на кнопку проверки. Также необходимо реализовать отображение истории проверок, которая была сохранена в базе данных.
Историю проверки сохранять при первичном запросе, т.е. при нажатии кнопки проверки. После исправления строки и автоматического запуска повторной проверки сохранять историю не нужно. Определение языка строки, поиск символов в ней и сохранение в базу данных должно происходить на стороне сервера.
