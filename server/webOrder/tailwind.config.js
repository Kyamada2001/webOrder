module.exports = {
  content: [
    "./resources/**/**/*.blade.php",
    "./resources/**/**/*.js",
    "./resources/**/**/components/*.vue",
    "./resources/**/**/views/**/*.vue", //コンポーネントと一緒にしてしまった方がいい？
    "./resources/**/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
