let txtLg = document.querySelectorAll('.flipLg');
let cardLg = document.querySelectorAll('.frontLg');
let backLg = document.querySelectorAll('.backLg');
let undoLg = document.querySelectorAll('.undoLg');

let txt = document.querySelectorAll('.flip');
let card = document.querySelectorAll('.front');
let back = document.querySelectorAll('.back');
let undo = document.querySelectorAll('.undo');

for (let i = 0; i < txtLg.length; i++){
  txtLg[i].addEventListener("click", (e) => {
    cardLg[i].classList.toggle('flipCard');
  })
}

for (let i = 0; i < txtLg.length; i++){
  undoLg[i].addEventListener("click", (e) => {
    cardLg[i].classList.toggle('flipCard');
  })
}

for (let i = 0; i < txt.length; i++){
  txt[i].addEventListener("click", (e) => {
    card[i].classList.toggle('flipCard');
  })
}

for (let i = 0; i < txt.length; i++){
  undo[i].addEventListener("click", (e) => {
    card[i].classList.toggle('flipCard');
  })
}