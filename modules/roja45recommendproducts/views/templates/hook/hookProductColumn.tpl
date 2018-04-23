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

<div id="roja45_recommend_products" class="col-lg-12 roja45_recommend_products product_column clearfix">
    <h4>{l s='Recommended Products' mod='roja45recommendproducts'}</h4>
    {if isset($products) AND $products}
        {assign var='liHeight' value=60}
        {assign var='nbItemsPerLine' value=1}
        {assign var='nbLi' value=$products|@count}
        {math equation="nbLi/nbItemsPerLine" nbLi=$nbLi nbItemsPerLine=$nbItemsPerLine assign=nbLines}
        {math equation="nbLines*liHeight" nbLines=$nbLines|ceil liHeight=$liHeight assign=ulHeight}
        <ul class="row">
            {foreach from=$products item=product name=homeFeaturedProducts}
            {math equation="(total%perLine)" total=$smarty.foreach.homeFeaturedProducts.total perLine=$nbItemsPerLine assign=totModulo}
                {if $totModulo == 0}{assign var='totModulo' value=$nbItemsPerLine}{/if}
            <li class="ajax_block_product col-lg-12 {if $smarty.foreach.homeFeaturedProducts.first}first_item{elseif $smarty.foreach.homeFeaturedProducts.last}last_item{else}item{/if} {if $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLine == 0}last_item_of_line{elseif $smarty.foreach.homeFeaturedProducts.iteration%$nbItemsPerLine == 1} {/if} {if $smarty.foreach.homeFeaturedProducts.iteration > ($smarty.foreach.homeFeaturedProducts.total - $totModulo)}last_line{/if}">
             	<div class="row recommend-product-container">
               		<form {if $PS_CATALOG_MODE && !isset($groups) && $product->quantity > 0} class="hidden"{/if} action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">
               			<p class="hidden">
                            <input type="hidden" name="token" value="{$static_token|escape:'htmlall':'UTF-8'}" />
                            <input type="hidden" name="id_product" value="{$product.id_product|intval|escape:'htmlall':'UTF-8'}" id="product_page_product_id" />
                        	<input type="hidden" name="add" value="1" />
                            <input type="hidden" name="id_product_attribute" id="idCombination" value="" />
                        </p>
                    	<div class="recommend-product-image col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    		<div class="row">
                    			<a href="{$link->getProductLink($product.id_product, null, null, null, $id_lang)|escape:'htmlall':'UTF-8'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">
                       				<img class="replace-2x img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'cart_default')|escape:'html':'UTF-8'}" alt="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" title="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" {if isset($thumbSize)} width="{$thumbSize.width|escape:'htmlall':'UTF-8'}" height="{$thumbSize.height|escape:'htmlall':'UTF-8'}"{/if} itemprop="image" />
                       			</a>
                       		</div>
                    	</div>
                    		<div class="recommend-product-detail col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        			<div class="row recommend-product-block">
                        				<h4 class="title_container">
                        					<a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}">{$product.name|truncate:85:'...'|escape:'htmlall':'UTF-8'}</a>
                        				</h4>
                        				{if $product.show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
                            			<h4 class="price_container">
                            				<span>{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price}{/if}</span>
                            			</h4>
                            			{else}
                            			<h4>&nbsp;</h4>
                            			{/if}
                        			</div>
                        		</div>
                        		<div class="recommend-product-buttons col-xs-12 col-sm-4 col-md-4 col-lg-4">
									<div class="row recommend-product-block-buttons">
                            			<div class="recommended-product-btn recommended-product-buy">
                               			{if ($product.id_product_attribute == 0 OR (isset($add_prod_display) AND ($add_prod_display == 1))) AND $product.available_for_order AND !isset($restricted_country_mode) AND $product.minimal_quantity == 1 AND $product.customizable != 2 AND !$PS_CATALOG_MODE}
                                    		{if ($product.quantity > 0 OR $product.allow_oosp)}
                                        	<button type="submit" name="Submit" class="no-print button ajax_add_to_cart_button btn btn-default btn-addtocart" data-id-product="{$product.id_product|intval}" title="{l s='Add to cart' mod='roja45recommendproducts'}"><span>{l s='Add to cart' mod='roja45recommendproducts'}</span></button>
                                			{/if}
                                		{else}
                                	    	<div style="height:23px;"></div>
                                		{/if}
                            			</div>

                            			<div class="recommended-product-btn recommended-product-view">
                                			<a type="button" class="no-print button lnk_view btn btn-default" href="{$link->getProductLink($product.id_product, null, null, null, $id_lang)|escape:'htmlall':'UTF-8'}" title="{l s='View' mod='roja45recommendproducts'}">
                                				<span>{l s='More Info' mod='roja45recommendproducts'}</span>
                                			</a>
                            			</div>
                        			</div>
                    			</div>
                        </form>
                    </div>
                </li>
            {/foreach}
        </ul>
    {else}
        <p class="no-recommendations">{l s='No Recommended Products' mod='roja45recommendproducts'}</p>
    {/if}
</div>
