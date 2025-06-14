import lightGallery from 'lightgallery';

const gallery = () => {
  const $lightgallery = document.getElementById('lightgallery');
  lightGallery($lightgallery, {
    mode: 'fade',
  });
};

export default gallery;
