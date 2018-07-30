{*
Popis proměnných, které jsou použitelné v šabloně XML feedu. Musí korespondovat s polem PrestaCenterXmlExportFree->allowedProperties.
Description of variables/placeholders you can use in XML feed template. All variables must be defined in PrestaCenterXmlExportFree->allowedProperties array.
*}
<b>{l s='Šablona XML' mod='prestacenterxmlexportfree'}</b><br /><br />
<u><a href="#" id="prestacenterxmlexportfreetoggle"></a></u>
<span id="prestacenterxmlexportfreeblock"><br /><br />
{l s='Prvek, který označuje produkt (např. SHOPITEM), označte atributem "ps_block" s hodnotou "product" (např. %s).' sprintf='&lt;SHOPITEM ps_block="product"&gt;' mod='prestacenterxmlexportfree'}<br /><br />
{l s='Pro hodnoty jednotlivých prvků můžete použít následující zástupné znaky (včetně složených závorek):' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{shop_name}{/literal}</b> - {l s='Název obchodu' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{shop_url}{/literal}</b> - {l s='URL obchodu' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{id}{/literal}</b> - {l s='ID produktu (= číslo podle databáze)' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{name}{/literal}</b> - {l s='Název produktu' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{manufacturer}{/literal}</b> - {l s='Název výrobce' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{ean}{/literal}</b> - {l s='Kód EAN13' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{upc}{/literal}</b> - {l s='Kód UPS' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{reference}{/literal}</b> - {l s='Reference' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{supplier_reference}{/literal}</b> - {l s='Kód produktu dodavatele' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{description}{/literal}</b> - {l s='Popis produkt' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{description_short}{/literal}</b> - {l s='Zkrácený popis produktu.' mod='prestacenterxmlexportfree'}
<br />
<b>{literal}{categories}{/literal}</b> - {l s='Kategorie, do kterých produkt patří (zobrazí se podobně jako drobečková navigace: "Oblečení | Dámské | Léto | Plavky". Jako oddělovač můžete zadat i jiný znak, např.:' mod='prestacenterxmlexportfree'}
	<b>{literal}{categories: "&gt;"}{/literal}</b><br />
<b>{literal}{url}{/literal}</b> - {l s='URL produktu v e-shopu' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{img_url}{/literal}</b> - {l s='URL obrázku produktu' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{condition}{/literal}</b> - {l s='Stav produktu (new, used, refurbished). Můžete použít ve feedu i vlastní hodnoty: doplňte je za dvojtečku, hodnoty oddělujte čárkou a zadávejte v pořadí pro "nový", "výprodej" a "repasovaný produkt", např.:' mod='prestacenterxmlexportfree'}
<b>{literal}{condition: "new,bazaar,bazaar"}{/literal}</b>.<br />
<b>{literal}{price_vat}{/literal}</b> - {l s='Cena s DPH jako desetinné číslo (např. "25.50")' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{price_vat_local}{/literal}</b> - {l s='Cena s DPH jako desetinné číslo, včetně zkratky měny (např. "25.50 Kč")' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{price_vat_iso}{/literal}</b> - {l s='Cena s DPH jako desetinné číslo, včetně zkratky měny podle ISO-4217 (např. "25.50 CZK")' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{online_only}{/literal}</b> - {l s='Jestli je produkt dostupný jen v eshopu (= 1), nebo i v kamenné prodejně (= 0).' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{update_item}{/literal}</b> - {l s='Datum a čas (v GMT), kdy byl produkt naposled změněn. Výchozí formát je pro Atom 1.0 (např. "2012-12-08T14:29:57+00:00"), ale můžete zvolit vlastní (význam jednotlivých znaků viz PHP funkce date). Příklad vlastního formátu:' mod='prestacenterxmlexportfree'} <b>{literal}{update_item: "Y/m/d H:i:s"}{/literal}</b><br />
<b>{literal}{update_feed}{/literal}</b> - {l s='Datum a čas, kdy byl feed vytvořen (v GMT). Stejně jako u předchozího můžete použít vlastní formát.' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{lang_code}{/literal}</b> - {l s='Kód jazyka, v němž je tento feed (např. "en-us" pro angličtinu).' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{lang_code_iso}{/literal}</b> - {l s='Dvoupísmenový kód jazyka podle ISO 639-1 (např. "en" pro angličtinu).' mod='prestacenterxmlexportfree'}<br /><br />
<b>{l s='Dostupnost produktů' mod='prestacenterxmlexportfree'}</b><br />
{l s='Pro dostupnost produktů máte k dispozici dvě proměnné: "days" a "availability". Obě se řídí tím, jestli je produkt skladem a jestli je dostupný pro objednávky (viz nastavení "Dostupné pro objednávky" na kartě Informace u editace produktu). Jestli jste u produktu zadali text, který se zobrazuje ve vašem obchodě (front office) podle toho, jestli produkt je / není skladem / lze objednat (viz karta Množství), mohou použít hodnoty z těchto textů. "Days" má jednodušší zpracování, použije se první číslo, které najde. Proměnná "availability" umí rozlišovat čísla (počet dní pro dodání) a data (např. od kdy bude produkt dostupný). Také si můžete nastavit různé vlastní hodnoty pro dostupnost, např. skladem / na objednávku / vyprodáno.' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{days}{/literal}</b> - {l s='Pokud je produkt skladem, vloží do feedu buď první číslo z textu, který se zobrazuje ve vašem obchodě u produktů skladem nebo nulu. Pokud produkt není skladem a u produktu jste nenastavili žádný text, nevrátí žádnou hodnotu. Potom záleží na nastavení tohoto feedu, jestli v XML smí být prázdný tag nebo ne.' mod='prestacenterxmlexportfree'}<br />
<b>{literal}{availability}{/literal}</b> - {l s='Tato proměnná umožňuje (podobně jako {condition}) zadat různé vlastní hodnoty. Výchozí funkčnost je tato: u produktů, které jsou skladem, vloží stejné číslo jako {days}. Totéž u produktů, které nejsou skladem, ale je možné je objednat. Nedostupné produkty se do feedu vůbec nevloží.' mod='prestacenterxmlexportfree'}<br />
{l s='Možnosti přizpůsobení: vlastní hodnoty se zadávají v pořadí "skladem", "na objednávku" a "vyprodané". Neměly by ale začínat mřížkou, ta je vyhrazena pro speciální hodnoty. Za čárkami můžete pro lepší čitelnost nechávat mezery.' mod='prestacenterxmlexportfree'}<br />
<br />
<b>{l s='Příklady:' mod='prestacenterxmlexportfree'}</b><br />
- <b>{literal}{availability: "in stock, on order, sold out"}{/literal}</b> - {l s='Vloží se zadané texty, do feedu se přidají i nedostupné produkty.' mod='prestacenterxmlexportfree'}<br />
- <b>{literal}{availability: "#, #:d.m.Y"}{/literal}</b> - {l s='U produktů skladem se vloží číslo. U produktů na objednávku buď číslo, anebo datum zformátované podle zadání (viz PHP funkce date). Výchozí chování pro nedostupné produkty se nebude měnit, takže jej lze vynechat.' mod='prestacenterxmlexportfree'}<br />
- <b>{literal}{availability: "3:immediately:expected product, #"}{/literal}</b> - {l s='Pokud chcete u produktů skladem ještě rozlišovat podle dodací lhůty, zadejte počet dní, hodnotu pokud je dostupnost menší nebo rovna počtu dní a hodnotu pro pozdější dostupnost, oddělujte dvojtečkou. Podle tohoto příkladu se u produktů skladem, které budou odeslány do tří dnů vloží hodnota "immediately" (ihned), u ostatních produktů skladem se vloží "expected product" (očekávany produkt). U produktů na objednávku se vloží číslo/datum.' mod='prestacenterxmlexportfree'}<br />
- <b>{literal}{availability: "#, #, #skipProduct"}{/literal}</b> - {l s='U produktů skladem se vloží číslo, u produktů na objednávku číslo nebo datum, nedostupné produkty se do feedu vůbec nepřidají (toto jsou výchozí hodnoty).' mod='prestacenterxmlexportfree'}<br />
- <b>{literal}{availability: "3:in stock:available for order, preorder, out of stock"}{/literal}</b> - {l s='Nastavení pro Nákupy Google (Google Merchant Center): U produktů, které budou odeslány do tří dnů včetně, se vloží "in stock", u ostatních produktů skladem "available for order". U produktů, které nejsou skladem, ale jsou povoleny objednávky, se vloží "preorder". U nedostupných produktů se vloží "out of stock".' mod='prestacenterxmlexportfree'}<br />
<br />
<b>{l s='Poznámka ke speciálním znakům' mod='prestacenterxmlexportfree'}</b><br />
{l s='Ze všech exportovaných dat se automaticky odstraňují HTML značky a speciální znaky (např. ostré závorky nebo &) se převádějí na HTML entity.' mod='prestacenterxmlexportfree'}
{* @version free *}
{l s='Toto chování si můžete v Pro verzi změnit podle vlastních požadavků.' mod='prestacenterxmlexportfree'}
{* /free *}<br />
</span>
{* skrývání nápovědy *}
<script>
$('#prestacenterxmlexportfreetoggle').click(function(button) {
	$('#prestacenterxmlexportfreeblock').fadeToggle( { 'complete' : function() {
		if ($('#prestacenterxmlexportfreeblock').css('display') === 'none') {
			$(button.target).text("{l s='Zobrazit nápovědu' mod='prestacenterxmlexportfree'}");
		} else {
			$(button.target).text("{l s='Skrýt nápovědu' mod='prestacenterxmlexportfree'}");
		}
	}});
});
$('#prestacenterxmlexportfreetoggle').click();
</script>
