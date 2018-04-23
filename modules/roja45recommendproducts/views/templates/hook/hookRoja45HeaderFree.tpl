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

<div id="immersive-modal-dialog" class="immersive-modal-dialog">
    <div id="modal-wait-icon">
        <i class="icon-refresh icon-spin animated"></i>
        <h2>{l s='Please Wait..' mod='roja45recommendproducts'}</h2>
    </div>
</div>

<div id="immersive-confirm-dialog" class="ui-dialog"  style="display:none">
    <div class="ui-dialog-titlebar"></div>
    <div class="ui-dialog-content">
        <p>{l s='You have warnings' mod='roja45recommendproducts'}</p>
    </div>
    <div class="ui-dialog-buttonpane"></div>
</div>


<div id="roja45_module_header">
    <div class="logo-block">
        <a href="http://roja45.com" target="_blank"><h1><span class="r1">ROJA</span><span class="r2">45</span></h1></a>
    </div>
    <div class="dontate-button">
    	<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
			<input type="hidden" name="cmd" value="_s-xclick">
			<input type="hidden" name="hosted_button_id" value="RCDYNHN6UDDLA">
			<div class="dontate-block title-block">
				<h2>{l s='Like This Module?  Buy me a coffee, coffee makes me work faster: ' mod='roja45recommendproducts'}</h2>
			</div>
			<div class="dontate-block payment-block">
			<table>
				<tr>
					<td>
						<select name="os0">
							<option value="Small Coffee">{l s='Small Coffee.  An hour of productivity: $3.00 USD' mod='roja45recommendproducts'}</option>
							<option value="Medium Coffee" selected="selected">{l s='Medium Coffee.  Good until lunch: $4.00 USD' mod='roja45recommendproducts'}</option>
							<option value="Maximum Caffine!">{l s='MAXIMUM CAFFINE! I HO, I HO, IT\'S OFF TO WORK I GO: $5.00 USD' mod='roja45recommendproducts'}</option>
						</select>
					</td>
				</tr>
			</table>
			</div>
			<input type="hidden" name="currency_code" value="USD">
			<div class="dontate-block image-block">
				<input type="image" src="https://www.paypalobjects.com/en_US/GB/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal � The safer, easier way to pay online.">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1">
			</div>
		</form>
    </div>
    <div class="support-block">
        <a href="https://www.prestashop.com/forums/topic/{$topic|escape:'htmlall':'UTF-8'}" target="_blank">{l s='Support' mod='roja45recommendproducts'}<i class="icon-chevron-right right"></i></a>
    </div>
</div>



<style type="text/css" style="display: none">

    #roja45_module_header {
    position: relative;
    background-color: white;
    padding: 28px;
    margin-bottom: 20px;
    border: solid 1px #DA4646;
    -webkit-border-radius: 5px;
    border-radius: 5px;
    }

    #roja45_module_header .logo-block {
    position: absolute;
    left: 15px;
    top: 0px;
    }

	#roja45_module_header .dontate-button {
    	position: absolute;
    	left: 200px;
    	top: 5px;
    }
    
	#roja45_module_header .dontate-button .dontate-block {
    	display: inline-block;
		height: 50px;
		top: 5px;
		vertical-align: middle;
    }
    
    #roja45_module_header .dontate-button .dontate-block h2 {
    	font-size: 20px;
		margin-top: 14px;
		margin-right: 5px;
    }
    #roja45_module_header .dontate-button .dontate-block table {
		margin-top: 10px;
    }
    
    #roja45_module_header .dontate-button .dontate-block.image-block {
    	margin-left: 10px;
    }
    
    #roja45_module_header a {
    text-decoration: none;
    }

    #roja45_module_header .logo-block h1 {
    font-size: 40px;
    margin-top: 5px;
    margin-bottom: 5px;
    font-weight: 700;
    }

    #roja45_module_header .logo-block a h1 .r1 {
    color: black;
    }
    #roja45_module_header .logo-block a h1 .r2 {
    color: red;
    }
    #roja45_module_header .logo-block a:hover h1 .r1 {
    color: black;
    text-decoration: underline;
    }
    #roja45_module_header .logo-block a:hover h1 .r2 {
    color: red;
    text-decoration: underline;
    }

    #roja45_module_header .support-block {
        position: absolute;
    right: 15px;
    color: red;
    top: 5px;
    }
    #roja45_module_header .support-block a {
    font-size: 15px;
    margin-top: 5px;
    margin-right: 5px;
    margin-bottom: 5px;
    font-weight: 700;
    color: red;
    text-transform: uppercase;
    }
    #roja45_module_header .support-block a:hover {
    text-decoration: underline;
    }
    #immersive-modal-dialog {
    display:none;
    position:fixed;
    top:0;
    left:0;
    background:black;
    width:100%;
    height:100%;
    z-index: 999;
    opacity: 0.7;
    }

    #immersive-modal-dialog #modal-wait-icon
    {
    width: 50px;
    height: 50px;
    text-align:center;
    position:absolute;
    left: 50%;
    top: 50%;
    margin-left:-10px;
    margin-top: -10px;
    }

    #immersive-modal-dialog #modal-wait-icon i {
    font-size: 50px;
    }

    .spin {
    -webkit-animation-name: spin;
    -webkit-animation-duration: 3000ms;
    -webkit-animation-iteration-count: infinite;
    -webkit-animation-timing-function: linear;
    -moz-animation-name: spin;
    -moz-animation-duration: 3000ms;
    -moz-animation-iteration-count: infinite;
    -moz-animation-timing-function: linear;
    -ms-animation-name: spin;
    -ms-animation-duration: 3000ms;
    -ms-animation-iteration-count: infinite;
    -ms-animation-timing-function: linear;
    -o-transition: rotate(3600deg);
    }

    .immersive-message-dialog {
    width: 200px;
    height: 50px;
    border-radius: 3px;
    position: absolute;
    z-index: 999;
    right: 0;
    bottom: 0;
    }

    .immersive-message-dialog.error {
    background-color: rgba(232, 30, 27, 0.5);
    }
    .immersive-message-dialog.warning {
    background-color: rgba(226, 173, 61, 0.5);
    }
    .immersive-message-dialog.success {
    background-color: rgba(40, 226, 10, 0.50);
    }
    #immersive-error-dialog {

    }

    #immersive-warning-dialog {

    }

    #growls.immersive {
    top: 95px;
    right: 10px;
    }
</style>