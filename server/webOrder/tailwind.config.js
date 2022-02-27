module.exports = {
  content: [
    "./resources/**/**/*.blade.php",
    "./resources/**/*.js",
    //"./resources/**/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  variants: {
    extend: {
      opacity: ['disabled'],
      cursor: ['disabled'],
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
