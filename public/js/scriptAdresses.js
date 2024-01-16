// Sélectionner toutes les adresses favorites
var favoriteAddresses = document.querySelectorAll('.favorite-address');
		
// Parcourir toutes les adresses favorites
favoriteAddresses.forEach(function(favoriteAddress) {
    
    // Ajouter un gestionnaire d'événements click à chaque adresse favorite
    favoriteAddress.addEventListener('click', function() {
        // Obtenir les valeurs de l'adresse favorite
        var street = favoriteAddress.dataset.street;
        var city = favoriteAddress.dataset.city;
        var zip = favoriteAddress.dataset.zip;
        // Mettre à jour les valeurs des champs du formulaire
        document.querySelector('#address_adresse').value = street;
        document.querySelector('#address_ville').value = city;
        document.querySelector('#address_codePostal').value = zip;
    });
    
});