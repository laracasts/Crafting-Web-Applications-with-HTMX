import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js'
  ],
  safelist: [
    {
        pattern: /text-(4xl|3xl|2xl|xl|lg|md|sm|xs|2xs)/,
    },
  ],
  theme: {
    fontSize: {
        DEFAULT: "15px",
        "2xs": "10px",
        xs: "12px",
        sm: "13px",
        md: "15px",
        lg: "16px",
        xl: "18px",
        "2xl": "20px",
        "3xl": "24px",
        "4xl": "28px",
    },
    extend: {
        fontFamily: {
            sans: ["hk-grotesk", ...defaultTheme.fontFamily.sans],
            title: ["kanit", ...defaultTheme.fontFamily.sans],
        },
        textColor: {
            DEFAULT: "#FFFFFF",
        },
        colors: {
            gray: {
                900: "#060606",
                800: "#121212",
                700: "#1A1A1A",
                600: "#1D1D1D",
                500: "#3B3B3B",
                400: "#414141",
                200: "#B4B4B4",
            },
            primary: {
                lowlight: "#0C1F63",
                DEFAULT: "#1544EF",
                highlight: "#0075FF",
            },
            alternate: {
                DEFAULT: "#FFFFFF",
            },
            secondary: {
                DEFAULT: "#A6B9FF",
            },
            error: {
                DEFAULT: "#D95454",
            },
        },
        ringColor: ({ theme }) => ({
            DEFAULT: theme("colors.alternate.DEFAULT"),
        }),
    },
},
  plugins: [forms, typography],
}

