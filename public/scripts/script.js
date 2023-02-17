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
    
    // Animation Text header
    headerAnimate: () => {
        const h1HeaderElm = document.querySelector('header h1');

        const writeH1 = new Typewriter(h1HeaderElm, {
            loop: false,
        });

        writeH1
            .typeString('Developpeur Web')
            .start();


        const h2HeaderElm = document.querySelector('header h2');

        const writeH2 = new Typewriter(h2HeaderElm, {
            loop: true,
            delay: 175,
        });

        writeH2
            // .typeString('FrontEnd <span style="color: #FF4500" class="strong">HTML</span>')
            // .pauseFor(2000)
            // .deleteChars(4)
            // .typeString('<span style="color: #01438E" class="strong"> CSS</span>')
            // .pauseFor(2000)
            // .deleteChars(3)
            .typeString('FrontEnd <span style="color: #F0DB4F" class="strong"> JavaScript</span>')
            .pauseFor(2000)
            .deleteChars(10)
            .typeString('<span style="color: #61dafb" class="strong"> React</span>')
            .pauseFor(2000)
            .deleteAll()
            .typeString('BackEnd <span style="color: #83CD29" class="strong"> Node</span>')
            .pauseFor(2000)
            .deleteChars(4)
            .typeString('<span class="strong"> Express</span>')
            .pauseFor(2000)
            .deleteChars(7)
            .typeString('<span style="color: #2379BD" class="strong"> Sequelize</span>')
            .pauseFor(2000)
            .deleteAll()
            .typeString('FullStack JavaScript')
            .pauseFor(2000)
            .deleteAll()
            .start();
    },

    // Apparition des elements au scroll
    
    scrollListner: () => {
        const ratio = 0.30;
        const observer = new IntersectionObserver(app.handleScroll, {threshold: ratio});

        const hardSkillElms = document.querySelectorAll('.hard-skill__cat');
        hardSkillElms.forEach(hardSkillElm => {
            observer.observe(hardSkillElm);
        })

        const softSkillElms = document.querySelectorAll('.soft-skill__item');
        softSkillElms.forEach(softSkillElm => {
            observer.observe(softSkillElm);
        })
        
    },

    handleScroll: (entries) => {
        entries.forEach(entry => {

            const targetElm = entry.target;
            const softSkillFirstChildElm = entry.target.firstElementChild;
            const softSkillLastChildElm = entry.target.lastElementChild;

            if (entry.isIntersecting) {
                
                if (targetElm.classList[0] === "hard-skill__cat") {
                    targetElm.classList.add('translateY');

                }else if (targetElm.classList[0] === "soft-skill__item") {
    
                    targetElm.classList.add('translateX-droite');
                    softSkillFirstChildElm.classList.add('translateX-gauche');
                    softSkillLastChildElm.classList.add('translateX-gauche');
                }
            }else {
                if (targetElm.classList[0] === "hard-skill__cat") {

                    targetElm.classList.remove('translateY');
                    
                }else if (targetElm.classList[0] === "soft-skill__item") {

                    targetElm.classList.remove('translateX-droite');
                    softSkillFirstChildElm.classList.remove('translateX-gauche');
                    softSkillLastChildElm.classList.remove('translateX-gauche');
                }
            }
        });
        
    },

    // Changement de la class colomn et row suivant la taille de l'ecran
    windowSeize: () => {
        
        const seize = window.innerWidth;
        const hardSkillElm = document.querySelector('#hard-skill');
        const softSkillElm = document.querySelector('#soft-skill');

        if(seize > 1000) {
            hardSkillElm.classList.remove('column');
            hardSkillElm.classList.add('row');
            softSkillElm.classList.add('row');
        }else {
            hardSkillElm.classList.remove('row');
            hardSkillElm.classList.add('column');
            softSkillElm.classList.remove('row');
        }
    },

    init: () => {
        app.headerAnimate();
        app.scrollListner();
        app.windowSeize();
        app.toggleMenu();
    },
};

window.addEventListener("DOMContentLoaded", () => {
    app.init();
  });

// A chaque changement de taille de fenetre, execusion de la fonction windowSeize
window.onresize = app.windowSeize;
    