<!--Compatible accessories cart products-->
{if isset($homeacc) && count($homeacc)>2}
        
                <ul class="clearfix homepromos">
                    <li class="htmlcontent-item-new">        
                            <strong>{l s='Accessories' mod='blockcartaccessories'}</strong><br />
                                {l s='Compatible accessories with your product(s) in your cart' mod='blockcartaccessories'}
                    </li>
                </ul>
        <!-- Products list -->
        <ul id="owl-sliderc" class="owl-carousel product_list grid prom">
            {foreach from=$homeacc item=product name=products}

                <li class="item ajax_block_product">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($product.legend)}{$product.legend|escape:'html':'UTF-8'}{else}{$product.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$product.link|escape:'html':'UTF-8'}" rel="{$product.link|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$product.link|escape:'html':'UTF-8'}" rel="{$product.link|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
                                            {if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$product type="old_price"}
                                                <span class="old-price product-price">
                                            {displayWtPrice p=$product.price_without_reduction}
                                        </span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
                                        {if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
                                    </span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$product type="price"}
                                            {hook h="displayProductPriceBlock" product=$product type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($product.new) && tzc_new_show2==1 && $product.new == 1}
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                {/if}
                                {if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$product.link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$product}
                            {hook h="displayProductPriceBlock" product=$product type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($product.pack_quantity) && $product.pack_quantity}{$product.pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$product.link|escape:'html':'UTF-8'}" title="{$product.name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$product.name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$product}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$product.description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($product.show_price) && $product.show_price && !isset($restricted_country_mode)}
                                        {if isset($product.specific_prices) && $product.specific_prices && isset($product.specific_prices.reduction) && $product.specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$product type="old_price"}
                                            <span class="old-price product-price">
                                    {displayWtPrice p=$product.price_without_reduction}
                                </span>
                                            {hook h="displayProductPriceBlock" id_product=$product.id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
                                {if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}
                            </span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$product type="price"}
                                        {hook h="displayProductPriceBlock" product=$product type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container{if $tzc_hover_show2== 1} hovereff{/if}">
                                {if ( ($tzc_but_show2 ==1) && ($product.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $product.available_for_order && !isset($restricted_country_mode) && $product.minimal_quantity <= 1 && $product.customizable != 2 && !$PS_CATALOG_MODE)}
                                    {if (!isset($product.customization_required) || !$product.customization_required) && ($product.allow_oosp || $product.quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$product.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$product.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$product.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$product.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
                                    <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                </span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2 ==1) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$product.link|escape:'html':'UTF-8'}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{l s='More' mod='blockcartaccessories'}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($product.color_list)}
                                <div class="color-list-container">{$product.color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order)))}
                                    {if isset($product.online_only) && $product.online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($product.on_sale) && $product.on_sale && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
                                {elseif isset($product.reduction) && $product.reduction && isset($product.show_price) && $product.show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($product.show_price) && $product.show_price) || (isset($product.available_for_order) && $product.available_for_order))))}

                                {if isset($product.available_for_order) && $product.available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
                                {if ($product.allow_oosp || $product.quantity > 0)}
                                    <span class="{if $product.quantity <= 0 && !$product.allow_oosp}out-of-stock{else}available-now{/if}">
                                        <link itemprop="availability" href="http://schema.org/InStock" />{if $product.quantity <= 0}{if $product.allow_oosp}{if isset($product.available_later) && $product.available_later}{$product.available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($product.available_now) && $product.available_now}{$product.available_now}{else}{l s='In Stock'}{/if}{/if}
                                    </span>
                                {elseif (isset($product.quantity_all_versions) && $product.quantity_all_versions > 0)}
                                    <span class="available-dif">
                                        <link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
                                    </span>
                                {else}
                                    <span class="out-of-stock">
                                        <link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
                                    </span>
                                {/if}
                            </span>
                                {/if}

                            {/if}
                        </div>
                        
                    </div><!-- .product-container> -->
                </li>
            {/foreach}
        </ul>
    <script>
        $(document).ready(function() {
            var owlc = $("#owl-sliderc");
            owlc.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,
            });
        });
    </script>  
{/if}
<!--Customer also bougth-->
{if isset($productodr) && count($productodr)}        
                <ul class="clearfix homepromos">
                    <li class="htmlcontent-item-new">        
                            <strong>{l s='Customers also bought' mod='blockcartaccessories'}</strong><br />
                                {l s='Customers who bought those products also bought' mod='blockcartaccessories'}
                    </li>
                </ul>
        <!-- Products list -->
        <ul id="owl-sliderh" class="owl-carousel product_list grid prom">
            {foreach from=$productodr item=productord name=products}

                <li class="item ajax_block_product">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link" href="{$productord.link|escape:'html':'UTF-8'}" title="{$productord.name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($productord.link_rewrite, $productord.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($productord.legend)}{$productord.legend|escape:'html':'UTF-8'}{else}{$productord.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$productord.link|escape:'html':'UTF-8'}" rel="{$productord.link|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$productord.link|escape:'html':'UTF-8'}" rel="{$productord.link|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($productord.show_price) && $productord.show_price) || (isset($productord.available_for_order) && $productord.available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($productord.show_price) && $productord.show_price && !isset($restricted_country_mode)}
                                            {if isset($productord.specific_prices) && $productord.specific_prices && isset($productord.specific_prices.reduction) && $productord.specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$productord type="old_price"}
                                                <span class="old-price product-price">
                                            {displayWtPrice p=$productord.price_without_reduction}
                                        </span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
                                        {if !$priceDisplay}{convertPrice price=$productord.price}{else}{convertPrice price=$productord.price_tax_exc}{/if}
                                    </span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$productord type="price"}
                                            {hook h="displayProductPriceBlock" product=$productord type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($productord.new) && ($tzc_new_show2 ==1) && $productord.new == 1}
                                    
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                    
                                {/if}
                                {if isset($productord.on_sale) && $productord.on_sale && isset($productord.show_price) && $productord.show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$productord.link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$productord}
                            {hook h="displayProductPriceBlock" product=$productord type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($productord.pack_quantity) && $productord.pack_quantity}{$productord.pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$productord.link|escape:'html':'UTF-8'}" title="{$productord.name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$productord.name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$productord}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$productord.description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($productord.show_price) && $productord.show_price) || (isset($productord.available_for_order) && $productord.available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($productord.show_price) && $productord.show_price && !isset($restricted_country_mode)}
                                        {if isset($productord.specific_prices) && $productord.specific_prices && isset($productord.specific_prices.reduction) && $productord.specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$productord type="old_price"}
                                            <span class="old-price product-price">
                                    {displayWtPrice p=$productord.price_without_reduction}
                                </span>
                                            {hook h="displayProductPriceBlock" id_product=$productord.id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
                                {if !$priceDisplay}{convertPrice price=$productord.price}{else}{convertPrice price=$productord.price_tax_exc}{/if}
                            </span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$productord type="price"}
                                        {hook h="displayProductPriceBlock" product=$productord type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container{if $tzc_hover_show2== 1} hovereff{/if}">
                                {if (($tzc_but_show2 ==1) && (isset($add_prod_display) && ($add_prod_display == 1)) && $productord.available_for_order && !isset($restricted_country_mode) && !$PS_CATALOG_MODE)}
                                    {if (!isset($productord.customization_required) || !$productord.customization_required) && ($productord.allow_oosp || $productord.quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$productord.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$productord.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$productord.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$productord.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
                                    <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                </span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$productord.link|escape:'html':'UTF-8'}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{l s='More' mod='blockcartaccessories'}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($productord.color_list)}
                                <div class="color-list-container">{$productord.color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($productord.show_price) && $productord.show_price) || (isset($productord.available_for_order) && $productord.available_for_order)))}
                                    {if isset($productord.online_only) && $productord.online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($productord.on_sale) && $productord.on_sale && isset($productord.show_price) && $productord.show_price && !$PS_CATALOG_MODE}
                                {elseif isset($productord.reduction) && $productord.reduction && isset($productord.show_price) && $productord.show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($productord.show_price) && $productord.show_price) || (isset($productord.available_for_order) && $productord.available_for_order))))}

                                {if isset($productord.available_for_order) && $productord.available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
                                {if ($productord.allow_oosp || $productord.quantity > 0)}
                                    <span class="{if $productord.quantity <= 0 && !$productord.allow_oosp}out-of-stock{else}available-now{/if}">
                                        <link itemprop="availability" href="http://schema.org/InStock" />{if $productord.quantity <= 0}{if $productord.allow_oosp}{if isset($productord.available_later) && $productord.available_later}{$productord.available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($productord.available_now) && $productord.available_now}{$productord.available_now}{else}{l s='In Stock'}{/if}{/if}
                                    </span>
                                {elseif (isset($productord.quantity_all_versions) && $productord.quantity_all_versions > 0)}
                                    <span class="available-dif">
                                        <link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
                                    </span>
                                {else}
                                    <span class="out-of-stock">
                                        <link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
                                    </span>
                                {/if}
                            </span>
                                {/if}

                            {/if}
                        </div>
                    </div><!-- .product-container> -->
                </li>
            {/foreach}
        </ul>
    <script>
        $(document).ready(function() {
            var owlh = $("#owl-sliderh");
            owlh.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,
            });
        });
    </script>  
{/if}
<!--Viewved product(s)-->
{if isset($productsViewedObj) && count($productsViewedObj) >0 && ($showviewed eq 1)}
                 <ul class="clearfix homepromos col-12">
                    <li class="htmlcontent-item-new">        
                            <strong>{l s='Viewed products' mod='blockcartaccessories'}</strong><br />
                              {l s='Your latest visited products' mod='blockcartaccessories'}
                    </li>
                </ul>
        <ul id="owl-slidera" class="owl-carousel product_list grid prom">
			{foreach from=$productsViewedObj item=viewedProduct name=products}
                        
                <li class="">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link"	href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)}" title="{$viewedProduct->name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($viewedProduct->link_rewrite, $viewedProduct->id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($viewedProduct->legend)}{$viewedProduct->legend|escape:'html':'UTF-8'}{else}{$viewedProduct->name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)}" rel="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)}" rel="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($viewedProduct->show_price) && $viewedProduct->show_price) || (isset($viewedProduct->available_for_order) && $viewedProduct->available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($viewedProduct->show_price) && $viewedProduct->show_price && !isset($restricted_country_mode)}
                                            {if isset($viewedProduct->specific_prices) && $viewedProduct->specific_prices && isset($viewedProduct->specific_prices.reduction) && $viewedProduct->specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$viewedProduct type="old_price"}
                                                <span class="old-price product-price">
											{displayWtPrice p=$viewedProduct->price_without_reduction}
										</span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$viewedProduct->price}{else}{convertPrice price=$viewedProduct->price_tax_exc}{/if}
									</span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$viewedProduct type="price"}
                                            {hook h="displayProductPriceBlock" product=$viewedProduct type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($viewedProduct->new) && tzc_new_show2==1 && $viewedProduct->new == 1}
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                {/if}
                                {if isset($viewedProduct->on_sale) && $viewedProduct->on_sale && isset($viewedProduct->show_price) && $viewedProduct->show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$viewedProduct->link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$viewedProduct}
                            {hook h="displayProductPriceBlock" product=$viewedProduct type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($viewedProduct->pack_quantity) && $viewedProduct->pack_quantity}{$viewedProduct->pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)}" title="{$viewedProduct->name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$viewedProduct->name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$viewedProduct}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$viewedProduct->description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($viewedProduct->show_price) && $viewedProduct->show_price) || (isset($viewedProduct->available_for_order) && $viewedProduct->available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($viewedProduct->show_price) && $viewedProduct->show_price && !isset($restricted_country_mode)}
                                        {if isset($viewedProduct->specific_prices) && $viewedProduct->specific_prices && isset($viewedProduct->specific_prices.reduction) && $viewedProduct->specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$viewedProduct type="old_price"}
                                            <span class="old-price product-price">
									{displayWtPrice p=$viewedProduct->price_without_reduction}
								</span>
                                            {hook h="displayProductPriceBlock" id_product=$viewedProduct->id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
								{if !$priceDisplay}{convertPrice price=$viewedProduct->price}{else}{convertPrice price=$viewedProduct->price_tax_exc}{/if}
							</span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$viewedProduct type="price"}
                                        {hook h="displayProductPriceBlock" product=$viewedProduct type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container{if $tzc_hover_show2== 1} hovereff{/if}">
                                {if ( ($tzc_but_show2 ==1) && ($viewedProduct->id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $viewedProduct->available_for_order && !isset($restricted_country_mode) && $viewedProduct->minimal_quantity <= 1 && $viewedProduct->customizable != 2 && !$PS_CATALOG_MODE)}
                                    {if (!isset($viewedProduct->customization_required) || !$viewedProduct->customization_required) && ($viewedProduct->allow_oosp || $viewedProduct->quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$viewedProduct->id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$viewedProduct->id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$viewedProduct->id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$viewedProduct->id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
									<span>{l s='Add to cart' mod='blockcartaccessories'}</span>
								</span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2 ==1) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite)}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{l s='More' mod='blockcartaccessories'}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($viewedProduct->color_list)}
                                <div class="color-list-container">{$viewedProduct->color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($viewedProduct->show_price) && $viewedProduct->show_price) || (isset($viewedProduct->available_for_order) && $viewedProduct->available_for_order)))}
                                    {if isset($viewedProduct->online_only) && $viewedProduct->online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($viewedProduct->on_sale) && $viewedProduct->on_sale && isset($viewedProduct->show_price) && $viewedProduct->show_price && !$PS_CATALOG_MODE}
                                {elseif isset($viewedProduct->reduction) && $viewedProduct->reduction && isset($viewedProduct->show_price) && $viewedProduct->show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($viewedProduct->show_price) && $viewedProduct->show_price) || (isset($viewedProduct->available_for_order) && $viewedProduct->available_for_order))))}

                                {if isset($viewedProduct->available_for_order) && $viewedProduct->available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
								{if ($viewedProduct->allow_oosp || $viewedProduct->quantity > 0)}
                                    <span class="{if $viewedProduct->quantity <= 0 && !$viewedProduct->allow_oosp}out-of-stock{else}available-now{/if}">
										<link itemprop="availability" href="http://schema.org/InStock" />{if $viewedProduct->quantity <= 0}{if $viewedProduct->allow_oosp}{if isset($viewedProduct->available_later) && $viewedProduct->available_later}{$viewedProduct->available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($viewedProduct->available_now) && $viewedProduct->available_now}{$viewedProduct->available_now}{else}{l s='In Stock'}{/if}{/if}
									</span>
								{elseif (isset($viewedProduct->quantity_all_versions) && $viewedProduct->quantity_all_versions > 0)}
									<span class="available-dif">
										<link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
									</span>
								{else}
									<span class="out-of-stock">
										<link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
									</span>
                                {/if}
							</span>
                                {/if}

                            {/if}
                        </div>
                        
                    </div><!-- .product-container> -->
                </li>
			{/foreach}
		</ul>
    <script>
        $(document).ready(function() {
            var owla = $("#owl-slidera");
            owla.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,

            });
        });
    </script>
{/if}
<!--Same product(s)-->
{if isset($sameprod) && count($sameprod)}
                 <ul class="clearfix homepromos">
                    <li class="htmlcontent-item-new">        
                            <strong>{l s='Similar products' mod='blockcartaccessories'}</strong><br />
                                {l s='Similar to the last visited product' mod='blockcartaccessories'}</a>                      
                    </li>
                </ul>
			<ul id="owl-sliderg" class="owl-carousel product_list grid prom">
			{foreach from=$sameprod item='viewedProduct' name=products}
                <li class="item ajax_block_product">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link"	href="{$viewedProduct.link|escape:'html':'UTF-8'}" title="{$viewedProduct.name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($viewedProduct.link_rewrite, $viewedProduct.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($viewedProduct.legend)}{$viewedProduct.legend|escape:'html':'UTF-8'}{else}{$viewedProduct.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$viewedProduct.link|escape:'html':'UTF-8'}" rel="{$viewedProduct.link|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$viewedProduct.link|escape:'html':'UTF-8'}" rel="{$viewedProduct.link|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($viewedProduct.show_price) && $viewedProduct.show_price) || (isset($viewedProduct.available_for_order) && $viewedProduct.available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($viewedProduct.show_price) && $viewedProduct.show_price && !isset($restricted_country_mode)}
                                            {if isset($viewedProduct.specific_prices) && $viewedProduct.specific_prices && isset($viewedProduct.specific_prices.reduction) && $viewedProduct.specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$viewedProduct type="old_price"}
                                                <span class="old-price product-price">
											{displayWtPrice p=$viewedProduct.price_without_reduction}
										</span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$viewedProduct.price}{else}{convertPrice price=$viewedProduct.price_tax_exc}{/if}
									</span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$viewedProduct type="price"}
                                            {hook h="displayProductPriceBlock" product=$viewedProduct type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($viewedProduct.new) && tzc_new_show2==1 && $viewedProduct.new == 1}
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                {/if}
                                {if isset($viewedProduct.on_sale) && $viewedProduct.on_sale && isset($viewedProduct.show_price) && $viewedProduct.show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$viewedProduct.link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$viewedProduct}
                            {hook h="displayProductPriceBlock" product=$viewedProduct type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($viewedProduct.pack_quantity) && $viewedProduct.pack_quantity}{$viewedProduct.pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$viewedProduct.link|escape:'html':'UTF-8'}" title="{$viewedProduct.name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$viewedProduct.name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$viewedProduct}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$viewedProduct.description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($viewedProduct.show_price) && $viewedProduct.show_price) || (isset($viewedProduct.available_for_order) && $viewedProduct.available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($viewedProduct.show_price) && $viewedProduct.show_price && !isset($restricted_country_mode)}
                                        {if isset($viewedProduct.specific_prices) && $viewedProduct.specific_prices && isset($viewedProduct.specific_prices.reduction) && $viewedProduct.specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$viewedProduct type="old_price"}
                                            <span class="old-price product-price">
									{displayWtPrice p=$viewedProduct.price_without_reduction}
								</span>
                                            {hook h="displayProductPriceBlock" id_product=$viewedProduct.id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
								{if !$priceDisplay}{convertPrice price=$viewedProduct.price}{else}{convertPrice price=$viewedProduct.price_tax_exc}{/if}
							</span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$viewedProduct type="price"}
                                        {hook h="displayProductPriceBlock" product=$viewedProduct type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container{if $tzc_hover_show2== 1} hovereff{/if}">
                                {if ( ($tzc_but_show2 ==1) && ($viewedProduct.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $viewedProduct.available_for_order && !isset($restricted_country_mode) && $viewedProduct.minimal_quantity <= 1 && $viewedProduct.customizable != 2 && !$PS_CATALOG_MODE)}
                                    {if (!isset($viewedProduct.customization_required) || !$viewedProduct.customization_required) && ($viewedProduct.allow_oosp || $viewedProduct.quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$viewedProduct.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$viewedProduct.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$viewedProduct.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$viewedProduct.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
									<span>{l s='Add to cart' mod='blockcartaccessories'}</span>
								</span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2 ==1) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$viewedProduct.link|escape:'html':'UTF-8'}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{l s='More' mod='blockcartaccessories'}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($viewedProduct.color_list)}
                                <div class="color-list-container">{$viewedProduct.color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($viewedProduct.show_price) && $viewedProduct.show_price) || (isset($viewedProduct.available_for_order) && $viewedProduct.available_for_order)))}
                                    {if isset($viewedProduct.online_only) && $viewedProduct.online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($viewedProduct.on_sale) && $viewedProduct.on_sale && isset($viewedProduct.show_price) && $viewedProduct.show_price && !$PS_CATALOG_MODE}
                                {elseif isset($viewedProduct.reduction) && $viewedProduct.reduction && isset($viewedProduct.show_price) && $viewedProduct.show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($viewedProduct.show_price) && $viewedProduct.show_price) || (isset($viewedProduct.available_for_order) && $viewedProduct.available_for_order))))}

                                {if isset($viewedProduct.available_for_order) && $viewedProduct.available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
								{if ($viewedProduct.allow_oosp || $viewedProduct.quantity > 0)}
                                    <span class="{if $viewedProduct.quantity <= 0 && !$viewedProduct.allow_oosp}out-of-stock{else}available-now{/if}">
										<link itemprop="availability" href="http://schema.org/InStock" />{if $viewedProduct.quantity <= 0}{if $viewedProduct.allow_oosp}{if isset($viewedProduct.available_later) && $viewedProduct.available_later}{$viewedProduct.available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($viewedProduct.available_now) && $viewedProduct.available_now}{$viewedProduct.available_now}{else}{l s='In Stock'}{/if}{/if}
									</span>
								{elseif (isset($viewedProduct.quantity_all_versions) && $viewedProduct.quantity_all_versions > 0)}
									<span class="available-dif">
										<link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
									</span>
								{else}
									<span class="out-of-stock">
										<link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
									</span>
                                {/if}
							</span>
                                {/if}

                            {/if}
                        </div>
                        
                    </div><!-- .product-container> -->
                </li>
			{/foreach}
		</ul>
	<script>
        $(document).ready(function() {
            var owla = $("#owl-sliderg");
            owla.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,
            });
        });
    </script>
{/if}

<!--Viewed accessories-->
 {if isset($homeaccv) && count($homeaccv)}
     <ul class="clearfix homepromos">
        <li class="htmlcontent-item-new">        
                <strong>{l s='Accessories' mod='blockcartaccessories'}</strong><br />
                    {l s='Compatible accessories with the last visited product' mod='blockcartaccessories'}</a>               
        </li>
    </ul>
 	<div class="single col-sm-12">
        <ul id="owl-sliderb" class="owl-carousel product_list grid prom">
			{foreach from=$homeaccv item=accessoryv name=accessoryv}
                <li class="item ajax_block_product">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link"	href="{$accessoryv.link|escape:'html':'UTF-8'}" title="{$accessoryv.name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($accessoryv.link_rewrite, $accessoryv.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($accessoryv.legend)}{$accessoryv.legend|escape:'html':'UTF-8'}{else}{$accessoryv.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$accessoryv.link|escape:'html':'UTF-8'}" rel="{$accessoryv.link|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$accessoryv.link|escape:'html':'UTF-8'}" rel="{$accessoryv.link|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($accessoryv.show_price) && $accessoryv.show_price) || (isset($accessoryv.available_for_order) && $accessoryv.available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($accessoryv.show_price) && $accessoryv.show_price && !isset($restricted_country_mode)}
                                            {if isset($accessoryv.specific_prices) && $accessoryv.specific_prices && isset($accessoryv.specific_prices.reduction) && $accessoryv.specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$accessoryv type="old_price"}
                                                <span class="old-price product-price">
											{displayWtPrice p=$accessoryv.price_without_reduction}
										</span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$accessoryv.price}{else}{convertPrice price=$accessoryv.price_tax_exc}{/if}
									</span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$accessoryv type="price"}
                                            {hook h="displayProductPriceBlock" product=$accessoryv type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($accessoryv.new) && tzc_new_show2==1 && $accessoryv.new == 1}
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                {/if}
                                {if isset($accessoryv.on_sale) && $accessoryv.on_sale && isset($accessoryv.show_price) && $accessoryv.show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$accessoryv.link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$accessoryv}
                            {hook h="displayProductPriceBlock" product=$accessoryv type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($accessoryv.pack_quantity) && $accessoryv.pack_quantity}{$accessoryv.pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$accessoryv.link|escape:'html':'UTF-8'}" title="{$accessoryv.name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$accessoryv.name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$accessoryv}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$accessoryv.description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($accessoryv.show_price) && $accessoryv.show_price) || (isset($accessoryv.available_for_order) && $accessoryv.available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($accessoryv.show_price) && $accessoryv.show_price && !isset($restricted_country_mode)}
                                        {if isset($accessoryv.specific_prices) && $accessoryv.specific_prices && isset($accessoryv.specific_prices.reduction) && $accessoryv.specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$accessoryv type="old_price"}
                                            <span class="old-price product-price">
									{displayWtPrice p=$accessoryv.price_without_reduction}
								</span>
                                            {hook h="displayProductPriceBlock" id_product=$accessoryv.id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
								{if !$priceDisplay}{convertPrice price=$accessoryv.price}{else}{convertPrice price=$accessoryv.price_tax_exc}{/if}
							</span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$accessoryv type="price"}
                                        {hook h="displayProductPriceBlock" product=$accessoryv type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container {if $tzc_hover_show2== 1} hovereff{/if}">
                                {if ( ($tzc_but_show2 ==1) && ($accessoryv.id_product_attribute == 0 || (isset($add_prod_display) && ($add_prod_display == 1))) && $accessoryv.available_for_order && !isset($restricted_country_mode) && $accessoryv.minimal_quantity <= 1 && $accessoryv.customizable != 2 && !$PS_CATALOG_MODE)}
                                    {if (!isset($accessoryv.customization_required) || !$accessoryv.customization_required) && ($accessoryv.allow_oosp || $accessoryv.quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$accessoryv.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$accessoryv.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$accessoryv.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$accessoryv.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
									<span>{l s='Add to cart' mod='blockcartaccessories'}</span>
								</span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2 ==1) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$accessoryv.link|escape:'html':'UTF-8'}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{l s='More' mod='blockcartaccessories'}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($accessoryv.color_list)}
                                <div class="color-list-container">{$accessoryv.color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($accessoryv.show_price) && $accessoryv.show_price) || (isset($accessoryv.available_for_order) && $accessoryv.available_for_order)))}
                                    {if isset($accessoryv.online_only) && $accessoryv.online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($accessoryv.on_sale) && $accessoryv.on_sale && isset($accessoryv.show_price) && $accessoryv.show_price && !$PS_CATALOG_MODE}
                                {elseif isset($accessoryv.reduction) && $accessoryv.reduction && isset($accessoryv.show_price) && $accessoryv.show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($accessoryv.show_price) && $accessoryv.show_price) || (isset($accessoryv.available_for_order) && $accessoryv.available_for_order))))}

                                {if isset($accessoryv.available_for_order) && $accessoryv.available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
								{if ($accessoryv.allow_oosp || $accessoryv.quantity > 0)}
                                    <span class="{if $accessoryv.quantity <= 0 && !$accessoryv.allow_oosp}out-of-stock{else}available-now{/if}">
										<link itemprop="availability" href="http://schema.org/InStock" />{if $accessoryv.quantity <= 0}{if $accessoryv.allow_oosp}{if isset($accessoryv.available_later) && $accessoryv.available_later}{$accessoryv.available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($accessoryv.available_now) && $accessoryv.available_now}{$accessoryv.available_now}{else}{l s='In Stock'}{/if}{/if}
									</span>
								{elseif (isset($accessoryv.quantity_all_versions) && $accessoryv.quantity_all_versions > 0)}
									<span class="available-dif">
										<link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
									</span>
								{else}
									<span class="out-of-stock">
										<link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
									</span>
                                {/if}
							</span>
                                {/if}

                            {/if}
                        </div>
                        
                    </div><!-- .product-container> -->
                </li>
			{/foreach}
		</ul>
	</div>       
    <script>
        $(document).ready(function() {
            var owlb = $("#owl-sliderb");
            owlb.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,
            });
        });
    </script>
{/if}
{if isset($news) && count($news)}
                <ul class="clearfix homepromos">
                    <li class="htmlcontent-item-new">        
                            <strong>{l s='New products' mod='blockcartaccessories'}</strong><br />
                                {l s='Our latests products' mod='blockcartaccessories'}
                    </li>
                </ul>
        <!-- Products list -->
        <ul id="owl-sliderj" class="owl-carousel product_list grid prom">
            {foreach from=$news item=productnew name=products}

                <li class="item ajax_block_product">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link"	href="{$productnew.link|escape:'html':'UTF-8'}" title="{$productnew.name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($productnew.link_rewrite, $productnew.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($productnew.legend)}{$productnew.legend|escape:'html':'UTF-8'}{else}{$productnew.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$productnew.link|escape:'html':'UTF-8'}" rel="{$productnew.link|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$productnew.link|escape:'html':'UTF-8'}" rel="{$productnew.link|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($productnew.show_price) && $productnew.show_price) || (isset($productnew.available_for_order) && $productnew.available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($productnew.show_price) && $productnew.show_price && !isset($restricted_country_mode)}
                                            {if isset($productnew.specific_prices) && $productnew.specific_prices && isset($productnew.specific_prices.reduction) && $productnew.specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$productnew type="old_price"}
                                                <span class="old-price product-price">
											{displayWtPrice p=$productnew.price_without_reduction}
										</span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$productnew.price}{else}{convertPrice price=$productnew.price_tax_exc}{/if}
									</span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$productnew type="price"}
                                            {hook h="displayProductPriceBlock" product=$productnew type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($productnew.new) && $tzc_new_show2 ==1 && $productnew.new == 1}
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                {/if}
                                {if isset($productnew.on_sale) && $productnew.on_sale && isset($productnew.show_price) && $productnew.show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$productnew.link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$productnew}
                            {hook h="displayProductPriceBlock" product=$productnew type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($productnew.pack_quantity) && $productnew.pack_quantity}{$productnew.pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$productnew.link|escape:'html':'UTF-8'}" title="{$productnew.name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$productnew.name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$productnew}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$productnew.description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($productnew.show_price) && $productnew.show_price) || (isset($productnew.available_for_order) && $productnew.available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($productnew.show_price) && $productnew.show_price && !isset($restricted_country_mode)}
                                        {if isset($productnew.specific_prices) && $productnew.specific_prices && isset($productnew.specific_prices.reduction) && $productnew.specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$productnew type="old_price"}
                                            <span class="old-price product-price">
									{displayWtPrice p=$productnew.price_without_reduction}
								</span>
                                            {hook h="displayProductPriceBlock" id_product=$productnew.id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
								{if !$priceDisplay}{convertPrice price=$productnew.price}{else}{convertPrice price=$productnew.price_tax_exc}{/if}
							</span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$productnew type="price"}
                                        {hook h="displayProductPriceBlock" product=$productnew type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container{if $tzc_hover_show2== 1} hovereff{/if}">
                                {if (($tzc_but_show2 ==1) && (isset($add_prod_display) && ($add_prod_display == 1)) && $productnew.available_for_order && !isset($restricted_country_mode) && !$PS_CATALOG_MODE)}
                                    {if (!isset($productnew.customization_required) || !$productnew.customization_required) && ($productnew.allow_oosp || $productnew.quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$productnew.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$productnew.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$productnew.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$productnew.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
									<span>{l s='Add to cart' mod='blockcartaccessories'}</span>
								</span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$productnew.link|escape:'html':'UTF-8'}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{if (isset($productnew.customization_required) && $productnew.customization_required)}{l s='Customize' mod='blockcartaccessories'}{else}{l s='More' mod='blockcartaccessories'}{/if}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($productnew.color_list)}
                                <div class="color-list-container">{$productnew.color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($productnew.show_price) && $productnew.show_price) || (isset($productnew.available_for_order) && $productnew.available_for_order)))}
                                    {if isset($productnew.online_only) && $productnew.online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($productnew.on_sale) && $productnew.on_sale && isset($productnew.show_price) && $productnew.show_price && !$PS_CATALOG_MODE}
                                {elseif isset($productnew.reduction) && $productnew.reduction && isset($productnew.show_price) && $productnew.show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($productnew.show_price) && $productnew.show_price) || (isset($productnew.available_for_order) && $productnew.available_for_order))))}

                                {if isset($productnew.available_for_order) && $productnew.available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
								{if ($productnew.allow_oosp || $productnew.quantity > 0)}
                                    <span class="{if $productnew.quantity <= 0 && !$productnew.allow_oosp}out-of-stock{else}available-now{/if}">
										<link itemprop="availability" href="http://schema.org/InStock" />{if $productnew.quantity <= 0}{if $productnew.allow_oosp}{if isset($productnew.available_later) && $productnew.available_later}{$productnew.available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($productnew.available_now) && $productnew.available_now}{$productnew.available_now}{else}{l s='In Stock'}{/if}{/if}
									</span>
								{elseif (isset($productnew.quantity_all_versions) && $productnew.quantity_all_versions > 0)}
									<span class="available-dif">
										<link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
									</span>
								{else}
									<span class="out-of-stock">
										<link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
									</span>
                                {/if}
							</span>
                                {/if}

                            {/if}
                        </div>

                    </div><!-- .product-container> -->
                </li>
            {/foreach}
        </ul>
    <script>
        $(document).ready(function() {
            var owlj = $("#owl-sliderj");
            owlj.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,
            });
        });
    </script>  
{/if}
{if isset($others) && count($others)}
                <ul class="clearfix homepromos">
                    <li class="htmlcontent-item-new">        
                            <strong>{l s='Recommended to you' mod='blockcartaccessories'}</strong><br />
                                {l s='Reduced price & Featured products' mod='blockcartaccessories'}
                    </li>
                </ul>
        <!-- Products list -->
        <ul id="owl-slideri" class="owl-carousel product_list grid prom">
            {foreach from=$others item=productoth name=products}

                <li class="item ajax_block_product">
                    <div class="product-container" itemscope itemtype="http://schema.org/Product">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link"	href="{$productoth.link|escape:'html':'UTF-8'}" title="{$productoth.name|escape:'html':'UTF-8'}" itemprop="url">
                                    <img class="replace-2x img-responsive" src="{$link->getImageLink($productoth.link_rewrite, $productoth.id_image, 'home_default')|escape:'html':'UTF-8'}" alt="{if !empty($productoth.legend)}{$productoth.legend|escape:'html':'UTF-8'}{else}{$productoth.name|escape:'html':'UTF-8'}{/if}" {if isset($homeSize)} width="{$homeSize.width}" height="{$homeSize.height}"{/if} itemprop="image" />
                                </a>
                                {if isset($quick_view) && $quick_view}
                                    <div class="quick-view-wrapper-mobile">
                                        <a class="quick-view-mobile" href="{$productoth.link|escape:'html':'UTF-8'}" rel="{$productoth.link|escape:'html':'UTF-8'}">
                                            <i class="icon-eye-open"></i>
                                        </a>
                                    </div>
                                    <a class="quick-view" href="{$productoth.link|escape:'html':'UTF-8'}" rel="{$productoth.link|escape:'html':'UTF-8'}">
                                        <span>{l s='Quick view' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                                {if (!$PS_CATALOG_MODE AND ((isset($productoth.show_price) && $productoth.show_price) || (isset($productoth.available_for_order) && $productoth.available_for_order)))}
                                    <div class="content_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        {if isset($productoth.show_price) && $productoth.show_price && !isset($restricted_country_mode)}
                                            {if isset($productoth.specific_prices) && $productoth.specific_prices && isset($productoth.specific_prices.reduction) && $productoth.specific_prices.reduction > 0}
                                                {hook h="displayProductPriceBlock" product=$productoth type="old_price"}
                                                <span class="old-price product-price">
											{displayWtPrice p=$productoth.price_without_reduction}
										</span>
                                            {/if}
                                            <span itemprop="price" class="price product-price">
										{if !$priceDisplay}{convertPrice price=$productoth.price}{else}{convertPrice price=$productoth.price_tax_exc}{/if}
									</span>
                                            <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                            {hook h="displayProductPriceBlock" product=$productoth type="price"}
                                            {hook h="displayProductPriceBlock" product=$productoth type="unit_price"}
                                        {/if}
                                    </div>
                                {/if}
                                {if isset($productoth.new) && $tzc_new_show2==1 && $productoth.new == 1}
                                    
                                        <span class="new-label">{l s='New' mod='blockcartaccessories'}</span>
                                    
                                {/if}
                                {if isset($productoth.on_sale) && $productoth.on_sale && isset($productoth.show_price) && $productoth.show_price && !$PS_CATALOG_MODE}
                                    <a class="sale-box" href="{$productoth.link|escape:'html':'UTF-8'}">
                                        <span class="sale-label">{l s='Sall' mod='blockcartaccessories'}</span>
                                    </a>
                                {/if}
                            </div>
                            {hook h="displayProductDeliveryTime" product=$productoth}
                            {hook h="displayProductPriceBlock" product=$productoth type="weight"}
                        </div>
                        <div class="right-block">
                            <h5 itemprop="name">
                                {if isset($productoth.pack_quantity) && $productoth.pack_quantity}{$productoth.pack_quantity|intval|cat:' x '}{/if}
                                <a class="product-name" href="{$productoth.link|escape:'html':'UTF-8'}" title="{$productoth.name|escape:'html':'UTF-8'}" itemprop="url" >
                                    {$productoth.name|truncate:45:'...'|escape:'html':'UTF-8'}
                                </a>
                            </h5>
                            {hook h='displayProductListReviews' product=$productoth}
                            <p class="product-desc{if $bcachnbr == 1}r{/if}" itemprop="description">
                                {$productoth.description_short|strip_tags:'UTF-8'|truncate:{$bcaccmaxacc}:'...'}
                            </p>
                            {if (!$PS_CATALOG_MODE AND ((isset($productoth.show_price) && $productoth.show_price) || (isset($productoth.available_for_order) && $productoth.available_for_order)))}
                                <div itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="content_price">
                                    {if isset($productoth.show_price) && $productoth.show_price && !isset($restricted_country_mode)}
                                        {if isset($productoth.specific_prices) && $productoth.specific_prices && isset($productoth.specific_prices.reduction) && $productoth.specific_prices.reduction > 0}
                                            {hook h="displayProductPriceBlock" product=$productoth type="old_price"}
                                            <span class="old-price product-price">
									{displayWtPrice p=$productoth.price_without_reduction}
								</span>
                                            {hook h="displayProductPriceBlock" id_product=$productoth.id_product type="old_price"}
                                        {/if}
                                        <span itemprop="price" class="price product-price">
								{if !$priceDisplay}{convertPrice price=$productoth.price}{else}{convertPrice price=$productoth.price_tax_exc}{/if}
							</span>
                                        <meta itemprop="priceCurrency" content="{$currency->iso_code}" />

                                        {hook h="displayProductPriceBlock" product=$productoth type="price"}
                                        {hook h="displayProductPriceBlock" product=$productoth type="unit_price"}
                                    {/if}
                                </div>
                            {/if}
                            <div class="button-container{if $tzc_hover_show2== 1} hovereff{/if}">
                                {if (($tzc_but_show2 ==1) && (isset($add_prod_display) && ($add_prod_display == 1)) && $productoth.available_for_order && !isset($restricted_country_mode) && !$PS_CATALOG_MODE)}
                                    {if (!isset($productoth.customization_required) || !$productoth.customization_required) && ($productoth.allow_oosp || $productoth.quantity > 0)}
                                        {if isset($static_token)}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, "add=1&amp;id_product={$productoth.id_product|intval}&amp;token={$static_token}", false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$productoth.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {else}
                                            <a class="button ajax_add_to_cart_button btn btn-default" href="{$link->getPageLink('cart',false, NULL, 'add=1&amp;id_product={$productoth.id_product|intval}', false)|escape:'html':'UTF-8'}" rel="nofollow" title="{l s='Add to cart' mod='blockcartaccessories'}" data-id-product="{$productoth.id_product|intval}">
                                                <span>{l s='Add to cart' mod='blockcartaccessories'}</span>
                                            </a>
                                        {/if}
                                    {else}
                                        <span class="button ajax_add_to_cart_button btn btn-default disabled">
									<span>{l s='Add to cart' mod='blockcartaccessories'}</span>
								</span>
                                    {/if}
                                {/if}
                                {if ($tzc_more_show2) }
                                <a itemprop="url" class="button lnk_view btn btn-default" href="{$productoth.link|escape:'html':'UTF-8'}" title="{l s='View' mod='blockcartaccessories'}">
                                    <span>{if (isset($productoth.customization_required) && $productoth.customization_required)}{l s='Customize' mod='blockcartaccessories'}{else}{l s='More' mod='blockcartaccessories'}{/if}</span>
                                </a>
                                {/if}
                            </div>
                            {if isset($productoth.color_list)}
                                <div class="color-list-container">{$productoth.color_list}</div>
                            {/if}
                            <div class="product-flags">
                                {if (!$PS_CATALOG_MODE AND ((isset($productoth.show_price) && $productoth.show_price) || (isset($productoth.available_for_order) && $productoth.available_for_order)))}
                                    {if isset($productoth.online_only) && $productoth.online_only}
                                        <span class="online_only">{l s='Online only' mod='blockcartaccessories'}</span>
                                    {/if}
                                {/if}
                                {if isset($productoth.on_sale) && $productoth.on_sale && isset($productoth.show_price) && $productoth.show_price && !$PS_CATALOG_MODE}
                                {elseif isset($productoth.reduction) && $productoth.reduction && isset($productoth.show_price) && $productoth.show_price && !$PS_CATALOG_MODE}
                                    <span class="discount">{l s='Reduced price!' mod='blockcartaccessories'}</span>
                                {/if}
                            </div>
                            {if ($tzc_qty_show2==1 && (!$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && ((isset($productoth.show_price) && $productoth.show_price) || (isset($productoth.available_for_order) && $productoth.available_for_order))))}

                                {if isset($productoth.available_for_order) && $productoth.available_for_order && !isset($restricted_country_mode)}
                                    <span itemprop="offers" itemscope itemtype="http://schema.org/Offer" class="availability">
								{if ($productoth.allow_oosp || $productoth.quantity > 0)}
                                    <span class="{if $productoth.quantity <= 0 && !$productoth.allow_oosp}out-of-stock{else}available-now{/if}">
										<link itemprop="availability" href="http://schema.org/InStock" />{if $productoth.quantity <= 0}{if $productoth.allow_oosp}{if isset($productoth.available_later) && $productoth.available_later}{$productoth.available_later}{else}{l s='In Stock'}{/if}{else}{l s='Out of stock'}{/if}{else}{if isset($productoth.available_now) && $productoth.available_now}{$productoth.available_now}{else}{l s='In Stock'}{/if}{/if}
									</span>
								{elseif (isset($productoth.quantity_all_versions) && $productoth.quantity_all_versions > 0)}
									<span class="available-dif">
										<link itemprop="availability" href="http://schema.org/LimitedAvailability" />{l s='Product available with different options' mod='blockcartaccessories'}
									</span>
								{else}
									<span class="out-of-stock">
										<link itemprop="availability" href="http://schema.org/OutOfStock" />{l s='Out of stock' mod='blockcartaccessories'}
									</span>
                                {/if}
							</span>
                                {/if}

                            {/if}
                        </div>
                    </div><!-- .product-container> -->
                </li>
            {/foreach}
        </ul>
    <script>
        $(document).ready(function() {
            var owli = $("#owl-slideri");
            owli.owlCarousel({
                items : {$items_wide2}, //10 items above 1000px browser width
                itemsDesktop : [1000,{$items_desktop2}], //5 items between 1000px and 901px
                itemsDesktopSmall : [900,{$items_desktop_small2}], // 3 items betweem 900px and 601px
                itemsTablet: [600,{$items_tablet2}], //2 items between 600 and 0;
                itemsMobile : {$items_mobile2}, // itemsMobile disabled - inherit from itemsTablet option
                autoPlay: {if $tzc_autoplay2 == 1}true{else}false{/if},
                navigation: {if $tzc_nav2 == 1}true{else}false{/if},
                navigationText: {if $tzc_nav_text2 == 1}true{else}false{/if},
                pagination: true,
            });
        });
    </script>  
{/if}