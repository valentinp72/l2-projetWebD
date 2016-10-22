jQuery(document).ready(function () {

    var menuOuvert = false; //Stocke l'état du menu

    //Ouverture du menu
    jQuery("#hamburger").click(function () {

        if(menuOuvert == false) { //Permet d'empecher la ré-ouverture du menu si il est déjà ouvert
            //On affiche le menu
            jQuery('#menu-hamburger').css('opacity', 1);
            jQuery('#menu-hamburger').css('display', 'block');

            //On enregistre l'offset en y de la page
            offsetY = window.pageYOffset;
            //On empeche le scroll
            jQuery('html').css('overflow', 'hidden');
            jQuery('html').css('height', '100%');
            jQuery('html').css('width', '100%');
            jQuery('html').css('position', 'fixed');



            jQuery('html').css('top', -offsetY + 'px');

            jQuery('#header').css('top', offsetY + 'px');

            jQuery('#contentLayer').css('display', 'block');
            jQuery('#contentLayer').css('position', 'fixed');





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
            jQuery('html').css('overflow', 'visible');
            jQuery('html').css('height', '100%');
            jQuery('html').css('width', '100%');
            jQuery('html').css('position', 'relative');

            jQuery('#header').css('top', 0 + 'px');

            jQuery('html').css('top', '0px');
            $(window).scrollTop(offsetY);
            // Reset the overlay scroll position to the top
            //$('html').scrollTop(0);

            //Activation du scroll sur les mobiles
            jQuery('#pageContent').unbind('touchmove');
        }

    });


});
