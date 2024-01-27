let xhr = new XMLHttpRequest();
xhr.open("POST", "http://127.0.0.1:80/tz/urlpost.php", true);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send("url=vk.com");

xhr.onreadystatechange = function ()
{
    if (this.readyState == 4 && this.status == 200)
    {
        document.getElementById("info").innerHTML = this.responseText;
    }
}
