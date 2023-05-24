window.addEventListener("load", () => {
    const inputPasswd = document.getElementById("p1");
    const inputPasswd2 = document.getElementById("p2");

    inputPasswd.addEventListener("mouseenter", () => {
        inputPasswd.setAttribute("type", "text");
    })
    inputPasswd.addEventListener("mouseleave", () => {
        inputPasswd.setAttribute("type", "password");
    })
    inputPasswd2.addEventListener("mouseenter", () => {
        inputPasswd2.setAttribute("type", "text");
    })
    inputPasswd2.addEventListener("mouseleave", () => {
        inputPasswd2.setAttribute("type", "password");
    })
})