// Place any jQuery/helper plugins in here.
// import gallery from './light-gallery';
console.log('plugins.js');

import dialogInfo from './dialog-info/index.js';
import showCookieBanner from './accept-cookie.js';
import serviceList from './service-list.js';

document.addEventListener('DOMContentLoaded', async () => {
  console.log('plugins.js 2');
  serviceList();
  const copyRightYear = document.querySelector('#footer__copyright-year');
  if (copyRightYear) {
    copyRightYear.textContent = new Date().getFullYear();
  }
  // await gallery();
  await dialogInfo.init();
  showCookieBanner();
});
