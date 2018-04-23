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

<form id="{$form_id|escape:'htmlall':'UTF-8'}" class="defaultForm form-horizontal" action="{$form_action|escape:'htmlall':'UTF-8'}" method="post" enctype="multipart/form-data" novalidate>
    <input type="hidden" name="{$form_submit_action|escape:'htmlall':'UTF-8'}"></input>
    <div class="panel">
        <div class="panel-heading">
            <i class="icon-cogs"></i>
            {l s='General Settings' mod='roja45recommendproducts'}
        </div>
        <div class="form-wrapper">
            <div class="form-group">
                <label class="control-label col-lg-3 required">
                    <span class="label-tooltip"
                          data-toggle="tooltip"
                          data-html="true"
                          title=""
                          data-original-title="{l s='Select Recommended Products By Category or Individually' mod='roja45recommendproducts'}">{l s='Selection Method' mod='roja45recommendproducts'}</span>
                </label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <select id="selection_method" name="selection_method"">
                            <option value="CAT" {if (isset($selection_method)) && ($selection_method=='CAT')}selected="selected"{/if}>{l s='By Category' mod='roja45recommendproducts'}</option>
                            <option value="PRD" {if (isset($selection_method)) && ($selection_method=='PRD')}selected="selected"{/if}>{l s='By Product' mod='roja45recommendproducts'}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3 required">
                    <span class="label-tooltip"
                          data-toggle="tooltip"
                          data-html="true"
                          title=""
                          data-original-title="{l s='Default Number Of Products To Display' mod='roja45recommendproducts'}">{l s='Number Of Products' mod='roja45recommendproducts'}</span>
                </label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <input type="text" name="number_of_products" id="number_of_products" value="{$number_of_products|escape:'htmlall':'UTF-8'}" class="" required="required">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">
                    <span class="label-tooltip"
                          data-toggle="tooltip"
                          data-html="true"
                          title=""
                          data-original-title="{l s='Display Random Products' mod='roja45recommendproducts'}">{l s='Display Random Products' mod='roja45recommendproducts'}</span>
                </label>
                <div class="col-lg-5">
                    <span class="switch prestashop-switch fixed-width-lg">
                        <input type="radio" name="display_random" id="display_random_on" value="1">
                        <label for="display_random_on">{l s='Yes' mod='roja45recommendproducts'}</label>
                        <input type="radio" name="display_random" id="display_random_off" value="0" checked="checked">
                        <label for="display_random_off">{l s='No' mod='roja45recommendproducts'}</label>
                        <a class="slide-button btn"></a>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-1"><span class="pull-right">{include file="controllers/products/multishop/checkbox.tpl" field="category_box" type="category_box"}</span></div>
                <label class="control-label col-lg-2" for="category_block">
                    <span class="label-tooltip"
                          data-toggle="tooltip"
                          data-html="true"
                          title=""
                          data-original-title="{l s='Products Form The Selected Category Will Be Displayed' mod='roja45recommendproducts'}">{l s='Select Category' mod='roja45recommendproducts'}</span>
                </label>
                <div class="col-lg-5">
                    <div id="category_block">
                        {* HTML CONTENT *}{$category_tree_html}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-3">
                    <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Search for an existing product by typing the first letters of its name.">
                        {l s='Search for a product' mod='roja45recommendproducts'}
                    </span>
                </label>
                <div class="col-lg-5">
                    <div class="input-group">
                        <input type="text" id="search_products" value="">
					<span class="input-group-addon">
						<i class="icon-search"></i>
					</span>
                    </div>
                </div>
            </div>
            <div id="roja45_recommended_products_found" style="display: none;">
                <hr>
                <div id="product_list" class="form-group">
                    <label class="control-label col-lg-3">{l s='Products' mod='roja45recommendproducts'}</label>
                    <div class="col-lg-3">
                        <select id="id_product"">
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-5 col-lg-offset-3">
                        <button type="button" class="btn btn-default" id="roja45_recommended_products_add">
                            <i class="icon-ok text-success"></i>
                            {l s='Add To Selection' mod='roja45recommendproducts'}
                        </button>
                    </div>
                </div>
            </div>
            <div id="roja45_recommended_products_err" class="hide alert alert-danger"></div>
            <div class="form-group">
                <label class="control-label col-lg-3">
                    <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Selected Recommended Products">
                        {l s='Selected Products' mod='roja45recommendproducts'}
                    </span>
                </label>
                <div class="col-lg-5">
                    <p>{l s='Selected Products' mod='roja45recommendproducts'}</p>
                    <select multiple id="roja45_selected_products" name="selected_products[]">
                        {foreach from=$selected_products item=product}
                            <option value="{$product.id_product|escape:'htmlall':'UTF-8'}">{$product.name|escape:'htmlall':'UTF-8'}</option>
                        {/foreach}
                    </select>
                    <a href="#" id="removeRecommendedProduct" class="btn btn-default btn-block">
                        {l s='Remove' mod='roja45recommendproducts'}
                        <i class="icon-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" value="1" id="roja45_recommend_products_submit_btn" name="{$form_submit_action|escape:'htmlall':'UTF-8'}" class="btn btn-default pull-right">
                <i class="process-icon-save"></i>
                {l s='Save' mod='roja45recommendproducts'}
            </button>
        </div>
    </div>
</form>

