$(document).ready(function (){

    $('#submit_id').remove();

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
        })
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
        })
        setTimeout(function(){location.reload()}, 500);
    })

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
        })
        setTimeout(function(){location.reload()}, 100);
    })
})