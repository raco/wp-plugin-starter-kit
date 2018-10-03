( function( $ ) {
    "use strict";
    $( function() {
        /* Script for the plugin settings page */
        /* Switch settings tabs */
        function switch_settings_tab( tab_id ) {
            // Update tabs
            $( '.nav-tab-wrapper .nav-tab' ).removeClass( 'nav-tab-active' );
            $( '.nav-tab-wrapper .nav-tab[href="' + tab_id + '"]' ).addClass( 'nav-tab-active' );
            // Update tabs content
            $( '#post-body-content .table' ).addClass( 'ui-tabs-hide' );
            $( '#post-body-content ' + tab_id ).removeClass( 'ui-tabs-hide' );
            // Update the form action to keep hash ( anchor ) after submitting the form
            $( '#post-body-content #plugin-settings-form' ).attr( 'action', 'options.php' + tab_id );
        }
        if ( $( '.nav-tab-wrapper' ).length > 0 ) {
            // Switch tabs content on page load
            var current_tab = window.location.hash;
            if ( current_tab == '' ) {
                current_tab = $( '.nav-tab' ).first().attr( 'href' );
                if ( history.pushState ) {
                    history.pushState( null, null, current_tab );
                } else {
                    window.location.hash = current_tab;
                }
            }
            switch_settings_tab( current_tab );
            // Switch tabs content on tab click
            $( '.nav-tab-wrapper > .nav-tab' ).on( 'click', function( event ) {
                event.preventDefault();
                var current_tab = $( '.nav-tab' ).closest( '.nav-tab-active' ).attr( 'href' ); // Get current ( active ) tab id
                var new_tab = $( this ).attr( 'href' ); // Get new tab id
                // switch settings tabs if new tab is other than active tab
                if ( current_tab !== new_tab ) {
                    switch_settings_tab( new_tab );
                    // Update location hash ( browser URL )
                    if ( history.pushState ) {
                        history.pushState( null, null, new_tab );
                    } else {
                        window.location.hash = new_tab;
                    }
                }
                return false;
            } );
        }
        /* Settings Fields */
        /* Colorpicker */
        if ( $( '.field-colorpicker' ).length > 0 ) {
            $( '.field-colorpicker' ).wpColorPicker();
            $( '.wp-picker-holder' ).click( function( event ) {
                event.preventDefault();
            } )
        }
        /* END Colorpicker */
        /* Image upload field */
        if ( $( '.upload-image-button' ).length > 0 ) {
            $( document ).on( 'click', '.upload-image-button', function() {
                var target_field = $( this ).closest( '.field-upload-image-wrapper' ).children( '.field-upload-image' );
                var target_field_preview = $( this ).closest( '.field-upload-image-wrapper' ).children( '.field-upload-image-preview' );
                window.send_to_editor = function( html ) {
                    var image_url = $( 'img', html ).attr( 'src' );
                    $( target_field ).val( image_url );
                    $( 'img', target_field_preview ).attr( 'src', image_url );
                    window.send_to_editor = window.original_send_to_editor;
                    tb_remove();
                }
                tb_show( 'Image Upload', 'media-upload.php?type=image&amp;TB_iframe=true&amp;post_id=0', false );
                return false;
            } );
        }
        /* END Image upload field */
    } );
}( jQuery ) );