const app = {
    toggleMenu: () => {
        // MENU TOGGLE
        const burgerToggler = document.querySelector('.burger');
        const navLinksContainer = document.querySelector('.nav__link');

        const toggleNav = () => {

            burgerToggler.classList.toggle('open');
            navLinksContainer.classList.toggle('open');
        }

        burgerToggler.addEventListener('click', toggleNav);
        navLinksContainer.addEventListener('click', toggleNav);
    },
    
    // Animation de type diaporama pour les sections
    switchSection: () => {

        // On recupere le conteneur de mes infos portfolio
        const main = document.querySelector(".containerInfos");

        // On récupère le conteneur des sections et le conteneur de projets
        let sections = document.querySelector(".sections");
        let projects = document.querySelector(".projects__container");

        // On récupère un tableau contenant les differentes sections et projets
        let sectionInfos = Array.from(sections.children);
        let projectInfos = Array.from(projects.children);

        // On récupère les deux flèches
        const right = document.querySelector("#nav-right");
        const left = document.querySelector("#nav-left");
        const up = document.querySelector("#nav-up");
        const down = document.querySelector("#nav-down");

        // On calcule la largeur visible du diaporama
        let mainWidth = main.getBoundingClientRect().width;
        let mainHeight = main.getBoundingClientRect().height;

        // Initialisation d'un compteur et 
        let compteurX = 0;
        let compteurY = 0;
        let decal;

        const navRight = () => {

            // Incrementation du compteur
            compteurX++;

            if(compteurX == sectionInfos.length){
                compteurX = 0;
            }

            decal = -mainWidth * compteurX;
            sections.style.transform = `translateX(${decal}px)`;
        }

        const navLeft = () => {

            // Incrementation du compteur
            compteurX--;

            if(compteurX == -1){
                compteurX = (sectionInfos.length - 1);
            }

            decal = -mainWidth * compteurX;
            sections.style.transform = `translateX(${decal}px)`;
        }

        const navDown = () => {

            // Incrementation du compteur
            compteurY++;

            if(compteurY == projectInfos.length){
                compteurY = 0;
            }

            decal = -mainHeight * compteurY;
            projects.style.transform = `translateY(${decal}px)`;
        }

        const navUp = () => {

            // Incrementation du compteur
            compteurY--;

            if(compteurY == -1){
                compteurY = (projectInfos.length - 1);
            }

            decal = -mainHeight * compteurY;
            projects.style.transform = `translateY(${decal}px)`;
        }


        // On met en place les écouteurs d'évènements sur les flèches
        right.addEventListener("click", navRight);
        left.addEventListener("click", navLeft);
        down.addEventListener("click", navDown);
        up.addEventListener("click", navUp);

        const resize = () => {
            mainWidth = main.getBoundingClientRect().width;
        }

        // Mise en oeuvre du "responsive"
        window.onresize = resize;

    },

    init: () => {
        app.toggleMenu();
        app.switchSection();
    },
};

window.addEventListener("DOMContentLoaded", () => {
    app.init();
  });

// A chaque changement de taille de fenetre, execusion de la fonction windowSeize
window.onresize = app.windowSeize;
    