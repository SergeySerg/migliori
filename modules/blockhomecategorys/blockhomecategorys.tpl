{if isset($subcategories)}
  {* <h2>{l s='Categorys' mod='blockhomecategorys'}</h2> *}
  <div id="subcategories" class="subcategories-on-main">
    <ul class="inline_list">
      {foreach from=$subcategories item=subcategory}
				<li class="clearfix">
					<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}" title="{$subcategory.name|escape:'htmlall':'UTF-8'}" class="img">
						{if $subcategory.id_image}
							<img src="{$link->getCatImageLink($subcategory.link_rewrite, $subcategory.id_image)}" alt="{$subcategory.name|escape:'htmlall':'UTF-8'}"/>
							<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}" class="cat_name cat_name-on-main">
								<span>{$subcategory.name|escape:'htmlall':'UTF-8'}<span>
							</a>
						{else}
							<img src="{$img_cat_dir}default-medium_default.jpg" alt="" width="{$mediumSize.width}" height="{$mediumSize.height}" />
							<a href="{$link->getCategoryLink($subcategory.id_category, $subcategory.link_rewrite)|escape:'htmlall':'UTF-8'}" class="cat_name cat_name-on-main"><span>{$subcategory.name|escape:'htmlall':'UTF-8'}<span></a>
						{/if}
					</a>
				</li>
      {/foreach}
			{literal}
				<script>
					$(document).ready(function() {
						$('#subcategories .inline_list li .img img').each(function(){
							var h = $(this).height();
							$(this).parent().parent().find('.cat_name-on-main').css('height', h);
						});
					});
				</script>
			{/literal}
    </ul>
    <br class="clear"/>
  </div>
{/if}
