// buyMe.js 1.4 
// Blog: dedushka.org/tag/buyme
// Forums: qbx.me
// nazarTokar@gmail.com
if($('#first-languages li:first-child.selected').length) {
	var bmeData = {
		"caption.description": "Чтобы оформить заказ, заполните форму. В течение пары часов с вами свяжется менеджер и уточнит детали заказа.", // описание в форме
		"caption.title": "Купить", // заголовок формы
		"caption.button": "Оформить", // надпись на кнопке

		"caption.sending": "Отправка", // отправка
		"caption.error": "Заполните все поля", // заполните все поля

		"txt.yes": "Да",
		"txt.no": "Нет",

		// укажите названия полей через запятую
		// чтобы добавить textarea, перед названием добавьте минус (-)
		// выпадающий список: !Название!Вариант1!Вариант2...
		// checkbox: ?Вопрос

		"fields": "Ваше имя(Укажите имя), Телефон (Номер телефона)*",

		"template": "default", // template name (default)

		"license": "0", // ключ лицензии (можно купить на get.nazartokar.com)
		"showCopyright": "0" // показывать ли копирайт?
	}
}
if($('#first-languages li:nth-child(2).selected').length) {
	var bmeData = {
		"caption.description": "Щоб оформити замовлення, заповніть форму.На протязі декількох годин з Вами звяжиться менеджер і уточнить деталі замовлення.", // описание в форме
		"caption.title": "Купити", // заголовок формы
		"caption.button": "Оформити", // надпись на кнопке

		"caption.sending": "Відправка", // отправка
		"caption.error": "Заповніть всі поля", // заполните все поля

		"txt.yes": "Так",
		"txt.no": "Ні",

		// укажите названия полей через запятую
		// чтобы добавить textarea, перед названием добавьте минус (-)
		// выпадающий список: !Название!Вариант1!Вариант2...
		// checkbox: ?Вопрос

		"fields": "Ваше ім'я(Вкажіть ім'я), Телефон (Номер телефону)*",

		"template": "default", // template name (default)

		"license": "0", // ключ лицензии (можно купить на get.nazartokar.com)
		"showCopyright": "0" // показывать ли копирайт?
	}
}