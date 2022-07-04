import '../styles/home.css';
import '../bootstrap';

const div = document.querySelector('.div');
const array = JSON.parse(div.dataset.array); // il remet en chaine de caractere
const object = JSON.parse(div.dataset.object);
const articles = JSON.parse(div.dataset.articles);
console.log(array.length);
console.log(object.length);
console.log(articles);