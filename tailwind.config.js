module.exports = {
  content: [
    './templates/**/*.{twig,html,js}',
    './public/**/*.html'
  ],
    future: {
      // removeDeprecatedGapUtilities: true,
      // purgeLayersByDefault: true,
    },
    theme: {
      extend: {},
    },
    variants: {},
    plugins: [require("daisyui")],
  }