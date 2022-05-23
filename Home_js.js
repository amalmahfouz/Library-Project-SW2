let searchBtn = document.querySelector('#search-btn');
let searchBar = document.querySelector('.search-bar-container');
let menu = document.querySelector('#menu-bar');
let navbar = document.querySelector('.navbar');




searchBtn.addEventListener('click', () =>{
    searchBtn.classList.toggle('fa-times'); /*change to clise icon*/
    searchBar.classList.toggle('active'); /*show search label */
});

window.onscroll = () =>{
    searchBtn.classList.remove('fa-times'); /*when scroll > close search button */
    searchBar.classList.remove('active');  /*when scroll > close search label */
    /*يعني لو فاتحة بحث بعدين عملت تمرير رح يغلق البحث و يرجع لاصله */
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');
}

window.onload = () =>{
  fadeOut();

}

function loader(){
  document.querySelector('.loader-container').classList.add('active');
}

function fadeOut(){
  setTimeout(loader, 1000);
}



menu.addEventListener('click', () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
});



