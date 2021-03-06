module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
      },
    },
    plugins: [require('daisyui')],
    daisyui: {
        darkTheme: "night",
        themes: ['fantasy', 'light', 'night'],
    },
    darkMode: 'class',
  }
