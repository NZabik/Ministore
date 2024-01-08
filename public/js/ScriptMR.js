$(document).ready(function () {
        // Charge le widget dans la DIV d'id "Zone_Widget" avec les paramètres indiqués  
        // et renverra le Point Relais sélectionné par l'utilisateur dans le champs d'ID "Retour_Widget"  
        $("#Zone_Widget").MR_ParcelShopPicker({
                Target: "#Target_Widget", // Selecteur JQuery de l'élément dans lequel sera renvoyé l'ID du Point Relais sélectionné (généralement un champ input hidden)  
                // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais pour affichage
                TargetDisplay: "#TargetDisplay_Widget",
                // Selecteur de l'élément dans lequel sont envoysé les coordonnées complètes du point relais
                TargetDisplayInfoPR: "#TargetDisplayInfoPR_Widget",
                Brand: "BDTEST  ", // Votre code client Mondial Relay  
                Country: "FR", // Code ISO 2 lettres du pays utilisé pour la recherche,  
                // Code postal pour lancer une recherche par défaut
                PostCode: "59300",
                // Habiller le widget aux couleurs Mondial Relay (thème par défaut si ce paramètre n'est pas renseigné)  
                Theme: "mondialrelay", // Mettre la valeur "inpost" (en minuscule) pour utiliser le thème graphique Inpost
                Responsive: true,
                ShowResultsOnMap: true,
                // Afficher les informations du point relais à la sélection sur la carte?
                DisplayMapInfo: true,
                // Fonction de callback déclenché lors de la selection d'un Point Relais
                OnParcelShopSelected:
                        // Fonction de traitement à la sélection du point relais.
                        // Remplace les données de cette page par le contenu de la variable data.
                        // data: les informations du Point Relais
                        function (data) {
                                $("#cb_ID").html(data.ID);
                                $("#cb_Nom").html(data.Nom);
                                $("#cb_Adresse").html(data.Adresse1 + ' ' + data.Adresse2);
                                $("#cb_CP").html(data.CP);
                                $("#cb_Ville").html(data.Ville);
                                $("#cb_Pays").html(data.Pays);
                        }
        });
});