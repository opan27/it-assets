/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./app/Views/**/*.{php,html}", // semua view CI4
    "./public/**/*.html"           // kalau ada file html di public
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
