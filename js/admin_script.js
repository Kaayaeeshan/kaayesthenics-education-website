let profile = document.querySelector(".header .flex .profile");
let searchForm = document.querySelector(".header .flex .search-form");
let footer = document.querySelector(".footer");
let body = document.body;
let slideBar = document.querySelector('.slide-bar');

/* by event handler
    
document.querySelector('#user-btn').onclick = ()=>{
    profile.classList.toggle('active');
};

*/

let profileToggle = document.querySelector('#user-btn');

profileToggle.addEventListener("click",()=>{
    profile.classList.toggle('active');
    searchForm.classList.remove('active');
});

window.onscroll=()=>{
    profile.classList.remove('active');
    searchForm.classList.remove('active');
    
    if(window.innerWidth < 1200){
    slideBar.classList.remove('active');
    body.classList.remove('active');
    footer.classList.remove('active');  
    };
};

document.querySelector("#menu-btn").onclick=()=>{
    slideBar.classList.toggle('active');
    body.classList.toggle('active');
    footer.classList.toggle('active');
};

document.querySelector("#search-btn").onclick = ()=>{
    searchForm.classList.toggle('active');
    profile.classList.remove('active');
};

document.querySelector(".slide-bar .close-bar").onclick =()=>{
    slideBar.classList.remove('active');
};