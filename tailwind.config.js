module.exports = {
  purge: [
    './templates/**/*.{twig,html,js}',
    './public/01_Tests/*.html'
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