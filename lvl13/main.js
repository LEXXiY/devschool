console.log('Задание 1');

var name = 'Алексей';
var age = 32;

console.log('Меня зовут '+name);
console.log('Мне '+age+' лет');

console.log('Задание 2');

const CITY = 'Москва';

console.log(CITY);

if(CITY) console.log(CITY+' определена');

//CITY = 'Самара'; выдает ошибку, переопределение констант не разрешено

if (CITY == 'Самара') {
    console.log(CITY);
} else {
    console.log('Не удалось переопределить константу');
}

console.log('Задание 3');

var book = {
        "title":"PHP. Объекты, шаблоны и методики программирования",
        "author":"Мэт Зандстра",
        "pages":560
    };
    
console.log("Недавно я прочитал книгу " +book.title+ ", написанную автором " +book.author+ ", я осилил все " +book.pages+ " страниц, мне она очень понравилась");

console.log('Задание 4');

var book1 = {
    "title":"PHP. Объекты, шаблоны и методики программирования",
    "author":"Мэт Зандстра",
    "pages":560
};
var book2 = {
    "title":"JavaScript. Подробное руководство",
    "author":"Дэвид Флэнаган",
    "pages":992
};
var books = [book1, book2];

var pages_sum = books[0].pages+books[1].pages;

console.log("Недавно я прочитал книги " +books[0].title+ " и " +books[1].title+ ", написанные соответственно авторами " +books[0].author+ " и " +books[1].author+ ", я осилил в сумме " +pages_sum+ " страниц, не ожидал от себя такого");