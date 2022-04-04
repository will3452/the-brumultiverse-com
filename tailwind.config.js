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
        themes: ['fantacy', 'light'],
    },
    darkMode: 'class',
  }
