$(document).ready(function (){

    $('#submit_filtres').remove();

    $('#filtres').ready(function (){
        var filtre = $.trim($('#filtre_produit').val());

        var motCles = $.trim($('#motscles').val());

        if (!motCles){
            motCles = "vide";
        }

        var parametre = 'filtre='+encodeURIComponent(filtre)+'&motcles='+encodeURIComponent(motCles);

        $.ajax({
            type:'GET',
            data: parametre,
            dataType: 'json',
            url: 'admin/lib/php/ajax/ajaxFiltreProduit.php',
            success: function (data){
                console.log(data);
            }
        });
    });

    $('#filtres').focusout(function (){
        var filtre = $.trim($('#filtre_produit').val());

        var motCles = $.trim($('#motscles').val());

        if (!motCles){
            motCles = "vide";
        }

        var parametre = 'filtre='+encodeURIComponent(filtre)+'&motcles='+encodeURIComponent(motCles);

        $.ajax({
            type:'GET',
            data: parametre,
            dataType: 'json',
            url: 'admin/lib/php/ajax/ajaxFiltreProduit.php',
            success: function (data){
                console.log(data);
            }
        });
        $("#toutlesproduits").load(" #toutlesproduits > *");
    });

    $('#modificationUtilisateur').ready(function (){
        var pseudo = $.trim($('#pseudo').val());

        var parametre = 'pseudo='+pseudo;

        $.ajax({
            type:'GET',
            data: parametre,
            dataType: 'json',
            url: 'admin/lib/php/ajax/ajaxGetUtilisateurByPseudo.php',
            success: function (data){
                console.log(data)
                $('#id_utilisateur').val(data[0].id_utilisateur);
                $('#prenom').val(data[0].prenom);
                $('#nom').val(data[0].nom);
                $('#email').val(data[0].email);
                $('#date_de_naissance').val(data[0].date_naissance);
            }
        });
    });


    $('#modificationUtilisateur').click(function (){
        var id = $.trim($('#id_utilisateur').val());
        var pseudo = $.trim($('#pseudo').val());
        var prenom = $.trim($('#prenom').val());
        var nom = $.trim($('#nom').val());
        var email = $.trim($('#email').val());
        var date_naissance = $.trim($('#date_de_naissance').val());

        var parametre = 'id_utilisateur='+id+'&pseudo='+encodeURIComponent(pseudo)+'&prenom='+encodeURIComponent(prenom)+'&nom='+encodeURIComponent(nom)+'&email='+encodeURIComponent(email)+'&date_naissance='+encodeURIComponent(date_naissance);

        $.ajax({
            type:'GET',
            data: parametre,
            dataType: 'json',
            url: 'admin/lib/php/ajax/ajaxUpdateUtilisateur.php',
            success: function (data){
                console.log(data);
            }
        });
        setTimeout(function(){location.reload()}, 500);
    });

    $('#AjoutAvis').click(function (){
        var pseudo = $.trim($('#pseudo').val());
        var date = $.trim($('#date').val());
        var message = $.trim($('#avisMessage').val());
        var id_produit = $.trim($('#id_produit').val());

        var parametre = 'pseudo='+encodeURIComponent(pseudo)+'&date='+encodeURIComponent(date)+'&message='+encodeURIComponent(message)+'&id_produit='+id_produit;

        $.ajax({
            type:'GET',
            data: parametre,
            dataType: 'json',
            url: 'admin/lib/php/ajax/ajaxAjoutAvis.php',
            success:function (data){
                console.log(data);
            }
        });
        setTimeout(function(){location.reload()}, 100);
    });


    $('span[id]').click(function(){
        var valeur1 = $.trim($(this).text());
        // récupération des attributs name et id de la zone cliquée

        var ident = $(this).attr("id"); //valeur de l'id

        $(this).blur(function (){
            var valeur2 = $.trim($(this).text());

            if(valeur1!=valeur2){
                var parametre = 'idProd='+ident+'&nouveau='+valeur2;
                $.ajax({
                    type: 'GET',
                    data: parametre,
                    dataType: 'text',
                    url: './admin/lib/php/ajax/ajaxUpdateQantiterProduitPanier.php',
                    success: function (data){
                        console.log(data);
                    }
                });
            }
           setTimeout(function(){location.reload()}, 500);
        });
    });

    $('#AjouterAuPanier').click(function (){
        var idProd = $.trim($(this).val());

        var parametre = 'idProd='+idProd;

        $.ajax({
            type: 'GET',
            data: parametre,
            dataType: 'text',
            url: './admin/lib/php/ajax/ajaxAjouterAuPanier.php',
            success: function (data){
                console.log(data);
            }
        });
    });

    $('#ViderPanier').click(function (){

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: './admin/lib/php/ajax/ajaxViderPanier.php',
            success: function (data){
               console.log(data)
            }
        });
        setTimeout(function(){location.reload()}, 500);
    });

    $('#facture').ready($('#facture').hide());

    $('#paypal').click(function () {
        $('#facture').show();
    })

    $('#AjouterAuPanier').click(function (){
        let boutton = this;
        boutton.classList.add('clicked');

        setTimeout(function (){boutton.classList.remove('clicked');},3100)
    });

})