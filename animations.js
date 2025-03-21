document.addEventListener("DOMContentLoaded", function () {
    let text = document.querySelector(".gradient-text");
    let colors = ["#4facfe", "#00f2fe", "#a18cd1"];
    let index = 0;
    setInterval(() => {
        text.style.background = `linear-gradient(90deg, ${colors[index]}, ${colors[(index + 1) % colors.length]})`;
        text.style.webkitBackgroundClip = "text";
        text.style.webkitTextFillColor = "transparent";
        index = (index + 1) % colors.length;
    }, 2000);
});