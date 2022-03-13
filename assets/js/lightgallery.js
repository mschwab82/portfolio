import lightGallery from "lightgallery";

import lgZoom from "lightgallery/plugins/zoom";

const $lgContainer = document.getElementById("gallery-container");

const lg = lightGallery($lgContainer, {
  speed: 500,
  showZoomInOutIcons: true,
  actualSize: false,
  plugins: [lgZoom]
});