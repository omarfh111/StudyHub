function deleteReclamation(element) {
    // Confirmer si l'utilisateur veut vraiment supprimer la réclamation
    if (confirm("Êtes-vous sûr de vouloir supprimer cette réclamation ?")) {
        const id = $(element).data('id'); // Récupérer l'ID de la réclamation

        // Effectuer une requête AJAX pour supprimer la réclamation
        $.ajax({
            url: 'Controller/delete.php', // Chemin vers votre fichier PHP qui gère la suppression
            type: 'POST',
            data: { id: id }, // Envoi de l'ID pour la suppression
            success: function(response) {
                if (response === 'success') {
                    // Si la suppression est réussie, retirer la ligne du tableau
                    $('#row-' + id).remove();
                    alert('Réclamation supprimée avec succès !');
                } else {
                    alert('Erreur lors de la suppression.');
                }
            },
            error: function() {
                alert('Erreur de communication avec le serveur.');
            }
        });
    }
}
