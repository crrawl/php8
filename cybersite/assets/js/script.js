window.addEventListener("scroll", scrollHeader);

function scrollHeader(){
    const header = document.querySelector("header");
    if(this.scrollY > 200){
        header.classList.add("scroll-header");
    } else {
        header.classList.remove("scroll-header");
    }
}

const hamburgerMenu = document.querySelector(".hamburger-menu");
const nav = document.querySelector("nav"); //active ir japieskir vecaka elementam, lai var

hamburgerMenu.onclick = () => {
    nav.classList.toggle("active");
}
