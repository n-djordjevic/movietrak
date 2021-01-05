// sidenav
const sideNav = document.getElementById("mobile-nav");
var sideNavInstance = M.Sidenav.init(sideNav, {});

// tabs
var el = document.querySelector('.tabs');
var tabsInstance = M.Tabs.init(el, {});

// // provera unosa datuma
function posaljiZahtev(){
    //na samom početku nam je bitno da su selektovani i zahtev i tabela
    if($("input[name=odabir_tabele]:checked").length!=0 && $("input[name=http_zahtev]:checked").length!=0){
        //ako jesu nastavljamo sa obradom zahteva
        //pamtimo koja je tabela u pitanju
        var tabela = $("input[name=odabir_tabele]:checked")[0].id;

        //i ponovo kroz switch prolazimo i obrađujemo svaki zahtev
        switch ( $("input[name=http_zahtev]:checked")[0].id){
            case "get":
            //kada je get u pitanju
            //proveravamo koja je tabela
                if(tabela=="radio_novosti"){
                    //i nakon toga pozivamo getJSON funkciju kojoj prosleđujemo link endpoint-a našeg API-a
                    //više od funkciji getJSON https://api.jquery.com/jquery.getjson/

                    //getJSON funkcija ima 2 bitna parametra, a to su url koji prosleđujemo i success funkcija koja kojom obrađujemo podatke koje smo dobili
                    //data parametar u okviru funkcije, predstavlja podatke poslate sa servera u JSON formatu
                    $.getJSON("http://localhost/ITEH/rest/api/novosti", function(data){
                        //postavljamo unutrašnji HTML div bloka get_odgovor na pretty string reprezentaciju JSON objekta
                        //string reprezentacija je mogla i da se postavi samo sa JSON.stringify(data)
                        // ali postavljamo i parametre null i 2 kako bi prikaz JSONa bio čitljiv
                        document.getElementById("get_odgovor").innerHTML = JSON.stringify(data,null,2);
                    });
                }else{
                    //ponavljamo istu proceduru samo za tabelu kategorije
                    $.getJSON("http://localhost/ITEH/rest/api/kategorije", function(data){
                        document.getElementById("get_odgovor").innerHTML = JSON.stringify(data,null,2);
                    });
                }
                break;
            case "post":
                if(tabela=="radio_novosti"){
            // kada je post zahtev u pitanju, potrebno je da 
            // prikupimo podatke koje hoćemo da pošaljemo iz forme
                    var values = {
                        "naslov": $("input[name=naslov_novosti]").val(),
                        "tekst":$("#tekst_novosti").val(),
                        "kategorija_id": parseInt($("#kategorija_odabir").val())
                    };
                    //ispisaćemo te podatke u konzoli kako bismo bili siguri da dobijamo dobar izlaz
                    //konzoli pristupamo u brauzeru sa CTRL+Shift+i i biramo tab Console
                    console.log(values);
                    //post zahtev se obrađuje na sličan način kao get
                    //potrebna su nam dva parametra u funkciji post
                    //url na koji šaljemo podatke
                    //koje podatke šaljemo
                    //i success funkcija u okviru koje prikazujemo odgovor sa servera
                    $.post("http://localhost/ITEH/rest/api/novosti", JSON.stringify(values),function(data){
                        alert("Odgovor od servera> "+data['poruka']);
                    });
                }else{
                    //na isti način radimo sa kategorijama, s tim što je potrebno da pokupimo njene vrednosti iz forme
                    var values ={
                        "kategorija": $("input[name=kategorija_naziv]").val(),
                    }
                    console.log(values);
                    $.post("http://localhost/ITEH/rest/api/kategorije", JSON.stringify(values),function(data){
                        alert("Odgovor od servera> "+data['poruka']);
                    });
                    
                }
                break;
            case "put":
                if (tabela == "radio_novosti") {
                    var id_value = document.getElementById("id_novosti").value;
                    var title_value = document.getElementById("naslov_novosti_put").value;
                    var text_value = document.getElementById("tekst_novosti_put").value;
                    var category_value = document.getElementById("kategorija_odabir_put").value;
                    $.ajax({
                        url: "http://localhost/ITEH/rest/api/novosti/" + id_value,
                        type: 'PUT',
                        data: JSON.stringify
                        ({
                            "naslov": title_value,
                            "tekst" : text_value,
                            "kategorija_id" : category_value
                        }),
                        success: function(data) {
                            alert("Odgovor od servera> "+data['poruka']);
                        }
                    });
                } else {
                    var category_id = document.getElementById("id_kategorije").value;
                    var category_title = document.getElementById("kategorija_naziv_put").value;
                    $.ajax({
                        url: "http://localhost/ITEH/rest/api/kategorije/" + category_id,
                        type: 'PUT',
                        data: JSON.stringify
                        ({
                            "kategorija" : category_title
                        }),
                        success: function(data) {
                            alert("Odgovor od servera> "+data['poruka']);
                        }
                    });
                }
                break;
            case "delete":
                var value = document.getElementById("brisanje").value;
                if (tabela == "radio_novosti") {
                    $.ajax({
                        url: "http://localhost/ITEH/rest/api/novosti/" + value,
                        type: 'DELETE',
                        success: function(data) {
                            alert("Odgovor od servera> "+data['poruka']);
                        }
                    });
                } else {
                    $.ajax({
                        url: "http://localhost/ITEH/rest/api/kategorije/" + value,
                        type: 'DELETE',
                        success: function(data) {
                            alert("Odgovor od servera> "+data['poruka']);
                        }
                    });
                }
                break;
            default:
                console.log("default");
        }
    }
}