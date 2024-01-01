module.exports = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        kgsblue: {
          dark: "#0e5499",
          light: "#8e9fcc",
        },
        kgsred: "#a34e1c",
      },
    },
  },
  variants: {},
  plugins: [require("@tailwindcss/typography")],
};
