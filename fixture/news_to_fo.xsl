<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet
	version="1.0"
	xmlns:fo="http://www.w3.org/1999/XSL/Format"
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
	xmlns:cmp3="http://www.bitmotion.de/cmp3/cmp3document">

	<xsl:import href="../../cmp3/xsl/rich_to_fo/rich_to_fo.xsl" />

	<xsl:output
		method="xml"
		version="1.0"
		encoding="utf-8"
		indent="yes" />


	<xsl:param name="cmp3_path_xml" />
	<xsl:param name="cmp3_path_output" />
	<xsl:param name="cmp3_path_xsl" />
	<xsl:param name="cmp3_path_config" />


	<xsl:template name="title">
		<xsl:value-of select=".//cmp3:field[@name='title']/cmp3:value" />
	</xsl:template>

	<xsl:template name="image">
		<xsl:attribute name="src">url('<xsl:value-of select=".//cmp3:field[@name='image']/cmp3:value" />')</xsl:attribute>
	</xsl:template>

	<xsl:template name="date">
		<xsl:value-of select=".//cmp3:field[@name='datetime']/cmp3:value" />
	</xsl:template>

	<xsl:template name="bodytext">
		<xsl:apply-templates select=".//cmp3:field[@name='bodytext']/cmp3:value" />
	</xsl:template>

	<xsl:template name="keywords">
		<xsl:value-of select=".//cmp3:field[@name='keywords']/cmp3:value" />
	</xsl:template>


	<xsl:template match="/">


			<fo:root xmlns:fo="http://www.w3.org/1999/XSL/Format">
				<fo:layout-master-set>
					<fo:simple-page-master master-name="only">
						<fo:region-body
							region-name="xsl-region-body"
							margin-top="50mm"
							margin-bottom="40mm"
							margin-left="30mm"
							margin-right="30mm" />
					</fo:simple-page-master>
				</fo:layout-master-set>



		<xsl:for-each select="//cmp3:record[@type='tt_news']">
				<fo:page-sequence master-reference="only">

					<fo:flow flow-name="xsl-region-body">

						<fo:block-container
							absolute-position="fixed"
							left="40mm"
							top="20mm"
							width="130mm"
							height="40mm">
							<fo:block
								font-size="0"
								width="130mm"
								height="40mm"
								text-align="center">
								<fo:external-graphic
									width="130mm"
									height="40mm"
									content-width="scale-to-fit"
									src="{$cmp3_path_xsl}HotNews.png">
								</fo:external-graphic>
							</fo:block>
						</fo:block-container>


						<fo:block-container
							absolute-position="fixed"
							left="40mm"
							top="50mm"
							width="130mm"
							height="26pt">
							<fo:block
								font-size="24pt"
								line-height="28pt"
								font-family="Helvetica"
								font-weight="bold"
								color="rgb-icc(0, 0, 0, #CMYK,0,0,0,1)">

								<fo:inline>
									<xsl:call-template name="title" />
								</fo:inline>
							</fo:block>
						</fo:block-container>


						<fo:block-container
							absolute-position="fixed"
							left="32mm"
							top="51mm"
							height="4mm"
							width="50mm"
							reference-orientation="90">
							<fo:block
								font-family="Helvetica"
								font-size="8pt"
								line-height="12pt"
								text-align="right"
								color="rgb-icc(127, 127, 127, #CMYK,0,0,0,0.5)">
								<fo:inline>
									<xsl:call-template name="date" />
								</fo:inline>
							</fo:block>
						</fo:block-container>


						<fo:block-container
							absolute-position="fixed"
							left="40mm"
							top="70mm"
							width="60mm"
							height="100mm"
							overflow="hidden">
							<fo:block
								font-size="0"
								width="70mm"
								height="100mm"
								text-align="center">
								<fo:external-graphic
									width="70mm"
									height="100mm"
									content-width="scale-to-fit">
									<xsl:call-template name="image">
									</xsl:call-template>
								</fo:external-graphic>
							</fo:block>
						</fo:block-container>


						<fo:block-container
							absolute-position="fixed"
							left="105mm"
							top="70mm"
							width="65mm"
							height="180mm"
							overflow="hidden">
							<fo:block
								font-size="9pt"
								line-height="14pt"
								font-family="Helvetica"
								font-weight="normal"
								font-style="normal"
								white-space-collapse="false"
								linefeed-treatment="treat-as-space"
								text-align="justify"
								text-align-last="left"
								line-stacking-strategy="font-height"
								hyphenate="true"
								color="rgb-icc(0, 0, 0, #CMYK,0,0,0,1)">
								<xsl:call-template name="bodytext" />
							</fo:block>
						</fo:block-container>



						<fo:block-container
							absolute-position="fixed"
							left="0mm"
							top="260mm"
							width="210mm"
							height="37mm"
							background-color="rgb(69, 79, 77)">
							<fo:block>
							</fo:block>
						</fo:block-container>


						<fo:block-container
							absolute-position="fixed"
							left="30mm"
							top="266mm"
							width="150mm"
							height="31mm">
							<fo:block
								font-size="9pt"
								font-family="Helvetica"
								color="rgb-icc(255, 255, 255, #CMYK,0,0,0,0)">

								<fo:block>
									<fo:inline>
										Produced with CMP3
									</fo:inline>
								</fo:block>
								<fo:block margin-top="1pt">
									<fo:inline>
										www.cross-media.net
									</fo:inline>
								</fo:block>
							</fo:block>
						</fo:block-container>


						<fo:block-container
							absolute-position="fixed"
							left="30mm"
							top="265mm"
							width="150mm"
							height="27mm">
							<fo:block
								font-size="0"
								width="150mm"
								height="27mm"
								text-align="right">
								<fo:external-graphic
									width="50mm"
									height="9mm"
									content-height="scale-to-fit"
									src="{$cmp3_path_xsl}bitmotion.png">
								</fo:external-graphic>
							</fo:block>
						</fo:block-container>


					</fo:flow>
				</fo:page-sequence>

		</xsl:for-each>

	</fo:root>

	</xsl:template>

</xsl:stylesheet>