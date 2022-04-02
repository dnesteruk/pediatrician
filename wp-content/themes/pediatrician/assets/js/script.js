jQuery(document).ready(function($){



});

document.addEventListener("DOMContentLoaded", function (){

    pediatrician_language_switcher()
    pediatrician_mobile_navigation()

});

window.addEventListener("load", function (){

});

function pediatrician_language_switcher() {
    const currentLang = document.getElementById('current-lang')
    if(currentLang) {
        currentLang.addEventListener('click', function (event) {
            event.preventDefault();

            const listLang = document.getElementById('list-lang')
            listLang.classList.toggle('show-list-lang')
        });
    }
}

function pediatrician_mobile_navigation() {
    const mobileNavigation = document.getElementById('header-mobile-navigation')

    if(mobileNavigation) {
        mobileNavigation.addEventListener('click', function (event) {
            const html = document.documentElement
            if(html.style.overflowY === '' || html.style.overflowY === 'scroll') {
                html.style.overflowY = 'hidden'
            } else {
                html.style.overflowY = 'scroll'
            }

            const headerWrapper = document.getElementById('header-wrapper')
            headerWrapper.classList.toggle('show-wrapper')

            const blockNavigation = document.getElementById('header-block-navigation')
            blockNavigation.classList.toggle('show-navigation')

            mobileNavigation.classList.toggle('show-menu')

            const primaryMenu = document.getElementById('primary-menu')
            const primaryMenuLinks = primaryMenu.querySelectorAll('a')
            for (let primaryMenuLink of primaryMenuLinks) {
                primaryMenuLink.addEventListener('click', function (event) {
                    mobileNavigation.click()
                    const linkAttribute = event.target.getAttribute("href")
                    if (linkAttribute === '#') {
                        event.preventDefault()
                    }
                });
            }

            const btnRegister = document.getElementById('header-btn-register')
            btnRegister.addEventListener('click', function (event) {
                mobileNavigation.click()
                if (btnRegister.getAttribute("href") === '#') {
                    event.preventDefault()
                }
            });
        });

    }
}
