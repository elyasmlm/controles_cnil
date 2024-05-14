function toggleView(view) {
    var mapSection = document.getElementById('mapSection');
    var statsSection = document.getElementById('statsSection');
    var statBtn = document.getElementById('statBtn');
    var mapBtn = document.getElementById('mapBtn');

    if (view === 'map') {
        mapSection.style.display = 'flex';
        statsSection.style.display = 'none';
        mapBtn.classList.add('active');
        statBtn.classList.remove('active');
    } else {
        mapSection.style.display = 'none';
        statsSection.style.display = 'block';
        mapBtn.classList.remove('active');
        statBtn.classList.add('active');
    }
}

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