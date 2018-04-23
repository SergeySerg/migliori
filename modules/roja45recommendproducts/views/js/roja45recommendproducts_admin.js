/**
 * roja45recommendproducts_admin.js
 *
 * @category  Roja45RecommendProducts
 * @author    Roja45
 * @copyright 2016 Roja45
 * @license   license.txt
 *
 * 2016 ROJA45 - All rights reserved.
 *
 * DISCLAIMER
 * Changing this file will render any support provided by us null and void.
 */
$(document).ready(function() {

    var ajaxPostPageOptions = {
        beforeSubmit: function(arr, $form, options) {
            try {
                var selected = [];
                $('#roja45_selected_products option').each( function( index ) {
                    //var current = [$(this).val(),$(this).text()];
                    //arr.push({ name: 'selected_products[]', value: current });
                    arr.push({ name: 'selected_products[]', value: $(this).val() });
                });
            } catch (error) {
                return false;
            }
        },
        success: function(response, statusText, xhr, $form) {
            displaySuccessMsg('Page Details Updated');
            toggleModal();
        },
        error: function(response, statusText, xhr, $form) {
            displayErrorMsg('Failed to update page details.');
            toggleModal();
        },
        type:      'post'
    };

    $('#roja45_recommend_products').submit(function() {
        validateAndSubmit(ajaxPostPageOptions);
        return false;
    });

    function validateAndSubmit(submitOptions) {
        try {
            toggleModal();
            $('#roja45_recommend_products').ajaxSubmit(submitOptions);
        } catch (Error) {
            displayErrorMsg( 'Fatal Error During Validation: ' + error );
            toggleModal();
            return false;
        }
    }

    $('#search_products').typeWatch({
        captureLength: 0,
        highlight: true,
        wait: 750,
        callback: function(){ searchProducts(); }
    });

    function searchProducts()
    {
        toggleModal();
        var search = $('#search_products').val();
        $.ajax({
            type:"POST",
            url: "/modules/roja45recommendproducts/roja45recommendproducts-ajax.php?ajax=1&method=searchForProducts&search=" + search,
            async: true,
            dataType: "json",
            success : function(res)
            {
                var products_found = '';
                var attributes_html = '';
                var customization_html = '';
                stock = {};

                if(res.found)
                {
                    $('#roja45_recommended_products_found').show();
                    $.each(res.products, function(index, val) {
                        products_found += '<option value="'+this.id_product+'"'+(index==0 ? 'selected="selected"' : '')+'>'+this.name+'</option>';
                        var id_product = this.id_product;
                    });
                    $('#roja45_recommended_products_found #id_product').html(products_found);
                    $('#roja45_recommended_products_found #id_product').change();
                }
                else
                {
                    $('#products_found').hide();
                    $('#products_err').html('No products found');
                    $('#products_err').removeClass('hide');
                }
                toggleModal();
            },
            error : function(res) {
                $('#products_found').hide();
                $('#products_err').html('No products found');
                $('#products_err').removeClass('hide');
                toggleModal();
            }
        });
    }

    $("#roja45_recommended_products_add").click( function() {
        var id_product = $('#id_product').val();
        var existing = $('#roja45_selected_products option[value='+ id_product +']');
        if(existing.length == 0) {
            var product_name = $('#id_product > option[value='+ id_product +']').text();
            var product_option = '<option name="product_selection[]" value="'+id_product+'">'+product_name+'</option>';
            $('#roja45_selected_products').append(product_option);
        }
        $('#roja45_selected_products').change();
    });

    $('#removeRecommendedProduct').click( function() {
        var id_product = $('#roja45_selected_products').val();
        $.each(id_product, function( index, value) {
            var existing = $('#roja45_selected_products option[value='+ value +']');
            existing.remove();
        });
    });

    $("#selection_method").change(toggleSelectionSettings).trigger("change");

    function toggleSelectionSettings() {
        if (( $( "select[name=selection_method] option:selected").val().toUpperCase()) == 'CAT') {
            $('#roja45_recommend_products #category_block').closest('div[class^="form-group"]').show();
            $('#roja45_recommend_products #search_products').closest('div[class^="form-group"]').hide();
            $('#roja45_recommend_products #roja45_selected_products').closest('div[class^="form-group"]').hide();

        } else {
            $('#roja45_recommend_products #category_block').closest('div[class^="form-group"]').hide();
            $('#roja45_recommend_products #search_products').closest('div[class^="form-group"]').show();
            $('#roja45_recommend_products #roja45_selected_products').closest('div[class^="form-group"]').show();
        }
    }

    function toggleModal() {
        $('#immersive-modal-dialog').toggle();
    }

    function displaySuccessMsg( msg ) {
        $.growl.notice({
            duration: 3000,
            location: 'immersive',
            title: 'Success',
            message: msg
        });
    }
    function displayWarningMsg( msg ) {
        $.growl.warning({
            duration: 6000,
            location: 'immersive',
            title: 'Warning',
            message: msg
        });
    }
    function displayErrorMsg( msg ) {
        $.growl.error({
            duration: 10000,
            location: "immersive",
            title: 'Error',
            message: msg
        });
    }

});