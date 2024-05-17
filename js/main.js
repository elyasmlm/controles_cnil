function openSwal(swalContent, header) {
    Swal.fire({
        title: header,
        html: swalContent,
        confirmButtonText: 'Ok',
        width: '80%',
        customClass: {
            container: 'container-class'
        }
    });
    $('#resultsTable').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "searching": true,
        "order": [[0, "asc"]], 
        "language": {
            "search": "Recherche :",
            "zeroRecords": "Aucun enregistrement correspondant trouvé",
            "info": "Affichage de la page _PAGE_ de _PAGES_",
            "infoEmpty": "Aucun enregistrement disponible",
            "infoFiltered": "(filtré à partir de _MAX_ enregistrements au total)",
            "lengthMenu": "Afficher _MENU_ enregistrements par page",
            "loadingRecords": "Chargement...",
            "processing": "Traitement...",
            "paginate": {
                "first": "Premier",
                "last": "Dernier",
                "next": "Suivant",
                "previous": "Précédent"
            }
        }
    });
}

function applyFilters() {
    var annee = $('#annee').val();
    var typeDeControle = $('#type_de_controle').val();
    var modalite = $('#modalite').val();
    var lieuControle = $('#lieu_controle').val();
    var secteurActivite = $('#secteur_activite').val();

    $.ajax({
        url: 'filter_data.php',
        type: 'GET',
        dataType: 'json',
        data: {
            annee: annee,
            type_de_controle: typeDeControle,
            modalite: modalite,
            lieu_controle: lieuControle,
            secteur_activite: secteurActivite
        },
        success: function(data) {
            console.log(data)
            updateMap(data);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
}

function updateMap(data) {
    markersLayer.clearLayers(); // Supprime tous les marqueurs actuels

    // Boucle sur chaque point de données pour ajouter un marqueur
    data.forEach(function(point) {
        addOnePinOnMap(point[0], point[1], point[2], point[3]); // point[2] devrait être le contenu du pop-up
    });
}

function resetFilters() {
    // Réinitialiser les valeurs des sélecteurs
    $('#annee').val('');
    $('#type_de_controle').val('');
    $('#modalite').val('');
    $('#lieu_controle').val('');
    $('#secteur_activite').val('');

    // Rafraîchir la carte en relançant la requête AJAX sans filtres
    applyFilters();
}
