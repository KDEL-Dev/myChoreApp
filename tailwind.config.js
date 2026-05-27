/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.html",
    "./**/*.php",
    "./**/*.html",
    "./**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        instrument: ['"Instrument Sans"', "sans-serif"],
        freeman: ['Freeman', "sans-serif"],
        noto: ['"Noto Sans"', "sans-serif"],
      }
    },
  },
  plugins: [],
}