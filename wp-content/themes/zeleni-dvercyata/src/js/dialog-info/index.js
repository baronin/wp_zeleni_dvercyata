const dialogInfo = {
  init() {
    this.openModal();
    this.closeModal();
  },
  openModal() {
    document.addEventListener('click', (event) => {
      if (!event.target.classList.contains('service-info__btn-learn-more')) return;

      const { target } = event;
      const dialogInfoElement = target.nextSibling;
      const dialogInfoModal = dialogInfoElement.nextElementSibling;

      dialogInfoModal.showModal();
      this.scrollLock();
    });
  },
  closeModal() {
    document.addEventListener('click', (event) => {
      if (!event.target.classList.contains('lesson-info__button-close')) return;

      const { target } = event;
      const dialogInfoModal = target.parentElement.parentElement;

      dialogInfoModal.close();
      this.scrollUnlock();
    });
  },
  scrollLock() {
    const { body } = document;
    body.style.overflow = 'hidden';
  },
  scrollUnlock() {
    const { body } = document;
    body.removeAttribute('style');
  },
};

export default dialogInfo;
