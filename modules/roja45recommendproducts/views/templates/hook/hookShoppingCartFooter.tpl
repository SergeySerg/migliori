{*
* 2016 ROJA45.COM
* All rights reserved.
*
* DISCLAIMER
*
* Changing this file will render any support provided by us null and void.
* 
*  @author 			Roja45 <support@roja45.com>
*  @copyright  		2016 roja45.com
*}

<div id="roja45_recommend_products" class="roja45_recommend_products shopping-cart-footer product_column clearfix">
	<script type="text/javascript">var roja45_middle = {$middlePosition|escape:'html':'UTF-8'};</script>
    <h2>{l s='Recommended Products' mod='roja45recommendproducts'}</h2>
    {if isset($products) AND $products}

        <div id="{if count($products) > 5}recommendproducts_scroll{else}recommendproducts_noscroll{/if}">
            {if count($products) > 5}<a id="recommendproducts_scroll_left" title="{l s='Previous' mod='roja45recommendproducts'}" href="javascript:{ldelim}{rdelim}"><i class="fa fa-chevron-left"></i>{l s='Previous' mod='roja45recommendproducts'}</a>{/if}
            <div id="recommendproducts_list">
                <ul class="clearfix">
                    {foreach from=$products item='product' name=product}
                        <li>
                            <a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|htmlspecialchars}" class="lnk_img"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'cart_default')|escape:'html':'UTF-8'}" alt="{$product.legend|escape:'html':'UTF-8'}" /></a>
                            <p class="product_name"><a href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}">{$product.name|escape:'html':'UTF-8'}</a></p>
                            {if $displayPrice AND $product.show_price == 1 AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                                <span class="price_display">
                                <span class="price">{displayPrice price=$product.price_tax_exc}</span>
                            </span>
                            {/if}
                            <p class="no-print">
                                <button type="button" class="button lnk_view btn btn-default" href="{$product.link|escape:'html':'UTF-8'}" title="{l s='View' mod='roja45recommendproducts'}"><span>{l s='More Info' mod='roja45recommendproducts'}</span></button>
                            </p>
                            <p class="no-print">
                                {if ($product.quantity > 0 OR $product.allow_oosp)}
                                    <button type="button" class="button ajax_add_to_cart_button btn btn-default" data-id-product="{$product.id_product|intval|escape:'html':'UTF-8'}" title="{l s='Add to cart' mod='roja45recommendproducts'}"><span>{l s='Add to cart' mod='roja45recommendproducts'}</span></button>
                                {else}
                                    <span class="exclusive">{l s='Add to cart' mod='roja45recommendproducts'}</span>
                                {/if}
                            </p>
                        </li>
                    {/foreach}
                </ul>
            </div>
            {if count($products) > 5}<a id="recommendproducts_scroll_right" title="{l s='Next' mod='roja45recommendproducts'}" href="javascript:{ldelim}{rdelim}">{l s='Next' mod='roja45recommendproducts'}<i class="fa fa-chevron-right"></i></a>{/if}
        </div>
    {/if}
</div>
