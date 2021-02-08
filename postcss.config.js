module.exports = {
  plugins: {
    // https://github.com/postcss/postcss/blob/main/docs/plugins.md
    // include whatever plugins you want
    // but make sure you install these via yarn or npm!

    // add browserslist config to package.json (see below)
    "postcss-px-to-viewport": {
      // https://github.com/evrone/postcss-px-to-viewport
      viewportWidth: 750,
      unitPrecision: 5,
      propList: ['*'],
      mediaQuery: true
    }
  }
}
