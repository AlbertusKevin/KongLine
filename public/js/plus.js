window.setInterval('close()', 3000);

function close() {
    document.getElementById("toastclose").style.display = "none";
}

function openChat() {
    document.getElementById("myChat").style.display = "block";
    document.getElementById("btnclosechat").style.display = "block";
}

function closeChat() {
    document.getElementById("myChat").style.display = "none";
    document.getElementById("btnclosechat").style.display = "none";
}