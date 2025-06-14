var userSettings = {
    Layout: "vertical", // vertical | horizontal
    SidebarType: "full", // full | mini-sidebar
    BoxedLayout: true, // true | false
    Direction: "ltr", // ltr | rtl
    // Theme: "light", // light | dark
    Theme: localStorage.getItem("user-theme") || "light",
    ColorTheme: "Blue_Theme", // Blue_Theme | Aqua_Theme | Purple_Theme | Green_Theme | Cyan_Theme | Orange_Theme
    cardBorder: false, // true | false
};
