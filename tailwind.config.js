module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    daisyui: {
        themes: [
            {
                mytheme: {
                    primary: "#5843AA",

                    secondary: "#521482",

                    accent: "#2dd4bf",

                    neutral: "#1e3a8a",

                    "base-100": "#F7F4FF",
                    "base-200": "#DBD5EA",

                    info: "#36257a",

                    success: "#36D399",

                    warning: "#FBBD23",

                    error: "#f43f5e",
                },
            },
        ],
    },

    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
};
