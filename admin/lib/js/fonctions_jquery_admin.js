$(document).ready(function (){
    $('span[id]').click(function(){
        var valeur1 = $.trim($(this).text());
        // récupération des attributs name et id de la zone cliquée

        var ident = $(this).attr("id"); //valeur de l'id
        var name = $(this).attr("name"); // champ à modifier

        $(this).blur(function (){
            var valeur2 = $.trim($(this).text());

            if(valeur1!=valeur2){
                // ecriture des parametre de l'url
                var parametre = 'champ='+name+'&id='+ident+'&nouveau='+valeur2;
                $.ajax({
                    type: 'GET',
                    data: parametre,
                    dataType: 'text',
                    url: './lib/php/ajax/ajaxUpdateCategorie.php',
                    async:false, //Set asynchronous as false
                    success: function (data){
                        console.log(data);
                    }
                });
            }
        });
    });

    $('#ajouter_categorie').click(function (){
        var nom = $.trim($('#nom_categorie').val());
        var parametre = 'nom_categorie='+nom;

        $.ajax({
            type: 'GET',
            data: parametre , // ce qui est envoyé à ajax produit detail
            dataType: 'json',
            url: './lib/php/ajax/ajaxAjoutCategorie.php',
            async:false,
            success: function (data){ // data ce qui est recu de ajax produit detail
                console.log(data);
            }
        })
    });

    $('#editer').ready(function (){
        var id = $.trim($('#id_produit').val());
        var parametre = 'id_produit='+id;

        $.ajax({
            type: 'GET',
            data: parametre, // ce qui est envoyé à ajax produit detail
            dataType: 'json',
            url: './lib/php/ajax/ajaxGetProduitById.php',
            success: function (data) { // data ce qui est recu de ajax produit detail
                console.log(data);
                $('#nom').val(data[0].nom);
                $('#photo').val(data[0].photo);
                $('#description').val(data[0].description);
                $('#choix_categorie').val(data[0].id_categorie);
                $('#stock').val(data[0].stock);
                $('#prix').val(data[0].prix);
            }
        })
    });

    $('#editer').click(function (){

        var id = $.trim($('#id_produit').val());
        var nom = $.trim($('#nom').val());
        var description = $.trim($('#description').val());
        var prix = $.trim($('#prix').val());
        var stock = $.trim($('#stock').val());
        var id_categorie = $.trim($('#choix_categorie').val());

        var parametre = 'id_produit='+id+'&nom='+encodeURIComponent(nom)+'&description='+encodeURIComponent(description)+'&prix='+encodeURIComponent(prix)+'&stock='+stock+'&id_categorie='+id_categorie;

        $.ajax({
            type: 'GET',
            data: parametre,
            dataType: 'json',
            url:'./lib/php/ajax/ajaxUpdateProduit.php',
            success: function (data){
                console.log(data);
            }
        });
        setTimeout(function(){location.reload()}, 100);
    });

    $('#supprimerUnAvis').click(function (){
        var id = $(this).val();

        var parametre = 'id='+id;

        $.ajax({
            type:'GET',
            data: parametre,
            dataType: 'json',
            url:'./lib/php/ajax/ajaxDeleteAvis.php',
            success: function (data){
                console.log(data)
            }
        })
        setTimeout(function(){location.reload()}, 100);
    });
})