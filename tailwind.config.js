module.exports = {
  purge: [
    './src/**/*.php',
    './src/**/*.vue',
    './src/**/*.jsx',
  ],
  theme: {
    extend: {
      colors: {
        'regal-blue': '#243c5a',
      }
    },
    // hier weiß ich nicht, wieso das nicht geht... Dit Fonts sind lokal installiert.
    // Eigentlich müsste es gehen...
    // https://stackoverflow.com/questions/61976785/how-do-you-use-custom-fonts-with-tailwindcss-and-nuxtjs
    fontFamily: {
      'roboto': ['Roboto', 'sans-serif'],
      'work-sans': ['Work Sans', 'sans-serif'],
    }
  },
  variants: {},
  plugins: [],
}
