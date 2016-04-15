var xhr = new XMLHttpRequest();
function each() {
    xhr.open('GET', 'http://adri326.890m.com/chatact.php');
    xhr.send();
}
function send() {
    var message = encodeURIComponent(document.getElementById('message').value);
    //alert("send "+message+" "+pseudo+" "+pw);
    xhr.open('GET', 'http://adri326.890m.com/chatact.php?message='+message+'&pseudo='+pseudo+'&password='+pw);
    xhr.withCredentials = true;
    //xhr.setRequestHeader('Set-Cookie', 'PHPSESSID='+sid);
    xhr.send();
    //document.getElementById('message').value = "";
}
xhr.addEventListener('readystatechange', function() {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
        if (xhr.responseText!="unchanged") {
            document.getElementById('chat').innerHTML = xhr.responseText;
            //setTimeout(each, 10000);
        }
    } else if (xhr.readyState === XMLHttpRequest.DONE && xhr.status != 200) {
        //alert('error while loading messages');
    }
    
});
setInterval(each, 60000);
each();