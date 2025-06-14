// Place any jQuery/helper plugins in here.
// import gallery from './light-gallery';
import dialogInfo from './dialog-info';
import showCookieBanner from './accept-cookie';
import serviceList from './service-list';

document.addEventListener('DOMContentLoaded', async () => {
  serviceList();
  const copyRightYear = document.querySelector('#footer__copyright-year');
  if (copyRightYear) {
    copyRightYear.textContent = new Date().getFullYear();
  }
  // await gallery();
  await dialogInfo.init();
  showCookieBanner();
});
