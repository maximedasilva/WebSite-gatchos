  function connect(page) {
        requeteAjax = new XMLHttpRequest();
        if (requeteAjax != null) {
            requeteAjax.open("GET", page, true);
            requeteAjax.onreadystatechange = handler;
            requeteAjax.send();
        }
    }
    function handler() {
        if (requeteAjax.readyState == 4) {
            if (requeteAjax.status == 200) {
                display()
            }
        }
    }
    function call(page) {
        connect(page);
    }
    function display() {
        var docXML = requeteAjax.responseXML;
        var reponses = docXML.getElementsByTagName("Nom_Musicien");
        var texte = "";
        for (i = 0; i < reponses.length; i++) {
            texte = texte + reponses[i].firstChild.textContent + " ";
        }
        var divliste = document.getElementById("musiciens");
        divliste.value = texte;
    }
