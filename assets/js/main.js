import "../scss/style.scss";

  // Include Lightbox 
import PhotoSwipeLightbox from '../../node_modules/photoswipe/dist/photoswipe-lightbox.esm.js';
import ObjectPosition from '../../node_modules/@vovayatsyuk/photoswipe-object-position/photoswipe-object-position.js';

const lightbox = new PhotoSwipeLightbox({
  // may select multiple "galleries"
  gallery: '#gallery--cropped-thumbs',

  // Elements within gallery (slides)
  children: 'a',

  // setup PhotoSwipe Core dynamic import
  pswpModule: () => import('../../node_modules/photoswipe/dist/photoswipe.esm.js')
});

new ObjectPosition(lightbox);

lightbox.init();