jQuery(document).ready(function () {

    var menuOuvert = false; //Stocke l'état du menu

    //Ouverture du menu
    jQuery("#hamburger").click(function () {
        
        if(menuOuvert == false) { //Permet d'empecher la ré-ouverture du menu si il est déjà ouvert
            //On affiche le menu
            jQuery('#menu-hamburger').css('opacity', 1);
            jQuery('#menu-hamburger').css('display', 'block');

            //On fixe le contenu de la page, pour empecher le scroll
            jQuery('#pageContent').css('position', 'fixed');
            jQuery('#contentLayer').css('display', 'block');

            //Ouverture de l'anti-scroll : décalage vers la gauche, permet de suivre le reste du contenu pour pouvroir cliquer dessus
            jQuery('#contentLayer').addClass('open');
            //Ouverture du contenu de la page : décalage vers la gauche
            jQuery('#pageContent').addClass('open');
           

            
            //Désactivation du scroll sur les mobiles
            jQuery('#pageContent').bind('touchmove', function (e) {
                e.preventDefault()
            });
            menuOuvert = true;
        }
        

        

    });

    //Fermeture du menu, on change le click en "click touchstart" pour être reconnu avec certains smartphones
    jQuery(document).on('click touchstart', function(event){

        if(jQuery(event.target).closest('#contentLayer').length && !$(event.target).closest("#hamburger").length) {


            jQuery('#pageContent').addClass('close');
            jQuery('#pageContent').removeClass('open');
            jQuery('#contentLayer').removeClass('open');

            setTimeout(function() {
                //Après 300ms, on masque le menu, et on retire la class close à au contenu
                jQuery('#menu-hamburger').css('opacity', 0);
                jQuery('#pageContent').removeClass('close');
                jQuery('#menu-hamburger').css('display', 'none');
                menuOuvert = false;
            }, 300);

            //On ré-autorise le scroll de la page
            jQuery('#contentLayer').css('display', 'none');
            jQuery('#pageContent').css('position', 'relative');

            //Activation du scroll sur les mobiles
            jQuery('#pageContent').unbind('touchmove');
        } 

    });


});
