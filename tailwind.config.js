module.exports = {
  purge: {
    // comment next 5 lines and run: "npm run build-css" to make public/style.css complete
    enabled: true,
    content: [
      './public/**/*.php',
      './public/**/*.js',
    ]
  },
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      screens: {
        'xs' : "400px",
      },
      minHeight: {
        '80px': '80px',
       },
       inset: {
         '-20vh' : '-20vh',
         '-24vh' : '-24vh',
       },
    },
  },
  variants: {
    extend: {
      // ...
     scale: ['group-hover'],
     backgroundColor: ['odd', 'even'],
    }
  },
  plugins: [],
}