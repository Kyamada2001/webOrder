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
          "slide-in-bck-left": "slide-in-bck-left 0.7s cubic-bezier(0.190, 1.000, 0.220, 1.000)   both",
          "text-focus-in": "text-focus-in 1s linear 0.5s  both",
          "text-focus-in-delay": "text-focus-in 1s linear 1s  both",
          "box-focus-in": "text-focus-in 1s linear   both"
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
          },
          "text-focus-in": {
            "0%": {
                filter: "blur(12px)",
                opacity: "0"
            },
            to: {
                filter: "blur(0)",
                opacity: "1"
            }
          },
          "text-focus-in-delay": {
            "0%": {
                filter: "blur(12px)",
                opacity: "0"
            },
            to: {
                filter: "blur(0)",
                opacity: "1"
            }
          },
          "box-focus-in": {
            "0%": {
                filter: "blur(12px)",
                opacity: "0"
            },
            to: {
                filter: "blur(0)",
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

