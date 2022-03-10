module.exports = {
  purge: [
    './templates/**/*.{twig,html,js}',
    './public/*.html'
  ],
    future: {
      // removeDeprecatedGapUtilities: true,
      // purgeLayersByDefault: true,
    },
    theme: {
      extend: {},
    },
    variants: {},
  }