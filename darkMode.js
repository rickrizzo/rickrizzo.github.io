let hour = new Date().getHours();
let body = document.body.style;
let a = document.getElementsByTagName('a')[0].style;

if(hour < 8 || hour > 15) {
  body.backgroundColor = 'black';
  body.color = 'white';
  a.color = 'orange';
}
