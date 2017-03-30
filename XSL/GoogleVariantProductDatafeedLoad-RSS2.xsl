<?xml version = "1.0"?>
<xsl:stylesheet version = "1.0" xmlns:xsl = "http://www.w3.org/1999/XSL/Transform" 
	xmlns:g = "http://base.google.com/ns/1.0"
>
<xsl:import href = "lib/StringFunctions.xsl" />
<xsl:output method = "text" encoding = "UTF-8" />
<xsl:strip-space elements = "*" />

<!--
**************************************************************************
DESCRIPTION:
This XSL is used to convert Google XML data into pipe-delimted text
for use with the ImportDatafeed task specifically for Horizon Fitness.

LAST MODIFIED:
2014-06-23
**************************************************************************
-->

<xsl:template match = "/rss/channel">
	<!-- Show the field headings -->
	<xsl:text>strProductName&#009;strBuyURL&#009;txtLongDescription&#009;strProductSKU&#009;UPC&#009;dblProductSalePrice&#009;strLargeImage&#009;dblProductPrice&#009;strDepartment&#009;strManufacturerPartNumber&#009;strBrandName&#009;strCategorization&#009;Item Group Id&#009;Color&#009;Size&#009;Pattern&#009;Material&#009;Age Group&#009;Gender&#009;Departement 2&#009;GTIN&#009;strProductSKU2&#009;strProductName2&#009;strBuyURL2&#009;strLongDescription2&#009;strSalePriceEffectiveDate
</xsl:text>

	<xsl:for-each select = "item">
		
		<!-- Product Name --><xsl:value-of select = "normalize-space(title)" /><xsl:text>&#009;</xsl:text>
		<!-- Buy URL --><xsl:value-of select = "normalize-space(link)" /><xsl:text>&#009;</xsl:text>
		<!-- Long Description --><xsl:value-of select = "normalize-space(description)" /><xsl:text>&#009;</xsl:text>
		<!-- Product SKU --><xsl:value-of select = "normalize-space(g:id)" /><xsl:text>&#009;</xsl:text>
		<!-- Product UPC --><xsl:value-of select = "normalize-space(g:upc)" /><xsl:text>&#009;</xsl:text>
		<!-- Sale Price --><xsl:value-of select = "normalize-space(g:sale_price)" /><xsl:text>&#009;</xsl:text>
		<!-- Large Image --><xsl:value-of select = "normalize-space(g:image_link)" /><xsl:text>&#009;</xsl:text>
		<!-- Product Price --><xsl:value-of select = "normalize-space(g:price)" /><xsl:text>&#009;</xsl:text>
		<!-- Department --><xsl:value-of select = "normalize-space(g:product_type)" /><xsl:text>&#009;</xsl:text>
		<!-- Manufacturer Part Number --><xsl:value-of select = "normalize-space(g:mpn)" /><xsl:text>&#009;</xsl:text>
		<!-- Brand Name --><xsl:value-of select = "normalize-space(g:brand)"/><xsl:text>&#009;</xsl:text>	
        <!-- Categorization --><xsl:value-of select = "normalize-space(g:google_product_category)" /><xsl:text>&#009;</xsl:text>
		<!-- Item Group Id --><xsl:value-of select = "normalize-space(g:item_group_id)" /><xsl:text>&#009;</xsl:text>
		<!-- Color --><xsl:value-of select = "normalize-space(g:color)" /><xsl:text>&#009;</xsl:text>
		<!-- Size --><xsl:value-of select = "normalize-space(g:size)" /><xsl:text>&#009;</xsl:text>
		<!-- Pattern --><xsl:value-of select = "normalize-space(g:pattern)" /><xsl:text>&#009;</xsl:text>
		<!-- Material --><xsl:value-of select = "normalize-space(g:material)" /><xsl:text>&#009;</xsl:text>
		<!-- Age Group --><xsl:value-of select = "normalize-space(g:age_group)" /><xsl:text>&#009;</xsl:text>
		<!-- Gender --><xsl:value-of select = "normalize-space(g:gender)" /><xsl:text>&#009;</xsl:text>
		<!-- Department2 --><xsl:value-of select = "normalize-space(product_type)" /><xsl:text>&#009;</xsl:text>
		<!-- GTIN --><xsl:value-of select = "normalize-space(g:gtin)" /><xsl:text>&#009;</xsl:text>
		<!-- Product SKU2 --><xsl:value-of select = "normalize-space(guid)" /><xsl:text>&#009;</xsl:text>
		<!-- Product Name2 --><xsl:value-of select = "normalize-space(g:title)" /><xsl:text>&#009;</xsl:text>
		<!-- Buy URL2 --><xsl:value-of select = "normalize-space(g:link)" /><xsl:text>&#009;</xsl:text>
		<!-- Long Description2 --><xsl:value-of select = "normalize-space(g:description)" /><xsl:text>&#009;</xsl:text>
		<!-- Sale Price Effective Date --><xsl:value-of select = "normalize-space(g:sale_price_effective_date)" />
		
		<xsl:text>
</xsl:text>

	</xsl:for-each>

</xsl:template>
 
</xsl:stylesheet>