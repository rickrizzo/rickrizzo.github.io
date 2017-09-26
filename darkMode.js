let hour = new Date().getHours();
let body = document.body.style;
let a = Array.prototype.slice.call(document.getElementsByTagName('a'));

if(hour < 8 || hour > 20) {
  body.backgroundColor = 'black';
  body.color = 'white';
  a.forEach(function(hyperlink) {
    hyperlink.style.color = 'orange';
  });
}
