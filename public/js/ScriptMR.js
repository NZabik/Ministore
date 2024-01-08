$(document).ready(function () {  
    // Charge le widget dans la DIV d'id "Zone_Widget" avec les paramètres indiqués  
    // et renverra le Point Relais sélectionné par l'utilisateur dans le champs d'ID "Retour_Widget"  
     $("#Zone_Widget").MR_ParcelShopPicker({     
             Target: "#Retour_Widget", // Selecteur JQuery de l'élément dans lequel sera renvoyé l'ID du Point Relais sélectionné (généralement un champ input hidden)  
             Brand: "BDTEST  ", // Votre code client Mondial Relay  
             Country: "FR", // Code ISO 2 lettres du pays utilisé pour la recherche,  
             // Habiller le widget aux couleurs Mondial Relay (thème par défaut si ce paramètre n'est pas renseigné)  
             Theme: "mondialrelay" // Mettre la valeur "inpost" (en minuscule) pour utiliser le thème graphique Inpost  
     });  
});