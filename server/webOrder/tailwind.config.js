module.exports = {
  content: [
    "./resources/**/**/*.blade.php",
    "./resources/**/**/*.js",
    "./resources/**/**/components/*.vue",
    "./resources/**/**/views/**/*.vue", //コンポーネントと一緒にしてしまった方がいい？
    "./resources/**/**/*.vue",
  ],
  theme: {
    extend: {
      animation: {
          "slide-in-bck-left": "slide-in-bck-left 0.7s cubic-bezier(0.190, 1.000, 0.220, 1.000)   both"
      },
      keyframes: {
          "slide-in-bck-left": {
              "0%": {
                  transform: "translateZ(700px) translateX(-400px)",
                  opacity: "0"
              },
              to: {
                  transform: "translateZ(0) translateX(0)",
                  opacity: "1"
              }
          }
      }
    }
  },
  variants: {
    visibility: ['responsive', 'hover', 'focus', 'group-hover']
  },
  plugins: [],
}

