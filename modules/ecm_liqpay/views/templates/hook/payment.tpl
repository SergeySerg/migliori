
<p class="payment_module">
	<a href="{$link->getModuleLink('ecm_liqpay', 'redirect', ['id_cart'=>$id_cart], true)}" title="{l s='liqpay' mod='ecm_liqpay'}" >
		<img src="{$this_path}liqpay.png" alt="{l s='liqpay' mod='ecm_liqpay'}" style="float:left;" />
		<br />{l s='Pay with liqpay' mod='ecm_liqpay'}
		<br style="clear:both;" />
	</a>
</p>
