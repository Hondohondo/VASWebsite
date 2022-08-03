/*Make mobile nav work*/

const btnNavEl = document.querySelector('.btn-mobile-nav');
const headerEl = document.querySelector('.header-navi');

btnNavEl.addEventListener('click', function () {
    headerEl.classList.toggle('navi-open');
})