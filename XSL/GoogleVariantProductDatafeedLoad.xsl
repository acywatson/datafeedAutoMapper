<?xml version = "1.0"?>
<xsl:stylesheet version = "1.0" xmlns:xsl = "http://www.w3.org/1999/XSL/Transform"
	xmlns:atom = "http://www.w3.org/2005/Atom"
	xmlns:g = "http://base.google.com/ns/1.0">
<xsl:import href = "lib/StringFunctions.xsl" />
<xsl:output method = "text" encoding = "UTF-8" />
<xsl:strip-space elements = "*" />

<!--
**************************************************************************
DESCRIPTION:
This XSL is used to convert XML data from Brave into delimited text
for use with the ImportDatafeed task.

LAST MODIFIED:
2015-03-31
**************************************************************************
-->

<xsl:template match = "/atom:feed">
	<!-- Show the field headings -->
	<xsl:text>strProductName|strProductSKU|strBrandName|strManufacturerPartNumber|strAttribute1|txtLongDescription|strBuyURL|strLargeImage|strDepartment|dblProductPrice|dblProductSalePrice|strCategorization|strAttribute2|strAttribute3|strAttribute4|strAttribute5|strAttribute6|strProductSKU2|txtSummary|strBuyURL2|strProductName2|strModelNumber
</xsl:text>

	<xsl:for-each select = "atom:entry">
		<xsl:if test='g:availability = "in stock"'>
			<xsl:value-of select = "normalize-space(atom:title)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:id)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:brand)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:mpn)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:gtin)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(atom:description)" /><xsl:text>|</xsl:text>
			<xsl:choose>
				<xsl:when test = "g:link">
					<xsl:value-of select = "normalize-space(g:link)" />
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select = "normalize-space(atom:link)" />
				</xsl:otherwise>
			</xsl:choose><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:image_link)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(atom:product_type)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:price)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:sale_price)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:google_product_category)" /><xsl:text>|</xsl:text>			
			<xsl:value-of select = "normalize-space(g:condition)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:expiration_date)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:gender)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:age_group)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:color)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(atom:id)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(atom:summary)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "atom:link/@href" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:title)" /><xsl:text>|</xsl:text>
			<xsl:value-of select = "normalize-space(g:model_number)" />
		</xsl:if>
		<xsl:text>
</xsl:text>

	</xsl:for-each>

</xsl:template>
 
</xsl:stylesheet>
