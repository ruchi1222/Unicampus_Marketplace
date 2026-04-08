<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:main="http://unimart.com/products"
    xmlns:book="http://unimart.com/books" 
    xmlns:stn="http://unimart.com/stationaries" 
    xmlns:tech="http://unimart.com/tech">

<xsl:template match="/">
    <html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <title>UniMart Products</title>
        <link rel="stylesheet" href="csstrial.css"/>
    </head>
    <body style="background-color: #fdf0f5; font-family: sans-serif;"> 
        <section class="categories">
            <h1 style="text-align: center; padding: 1px; color: #e91e63;">UniMart Products</h1>
            <hr class="title-line" style="width: 100%; margin: auto; border: 1px solid #e91e63;"/>
            
            <div class="category-section">
                <h2 style="margin-left: 5%; color: #333; border-bottom: 2px solid #f06292; display: inline-block;">Books</h2>
                <div class="shop__container" style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <xsl:for-each select="/main:unimart/book:product">
                        <xsl:call-template name="product-card"/>
                    </xsl:for-each>
                </div>
            </div>

            <div class="category-section">
                <h2 style="margin-left: 5%; color: #333; border-bottom: 2px solid #f06292; display: inline-block;">Stationaries</h2>
                <div class="shop__container" style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <xsl:for-each select="/main:unimart/stn:product">
                        <xsl:call-template name="product-card"/>
                    </xsl:for-each>
                </div>
            </div>

            <div class="category-section">
                <h2 style="margin-left: 5%; color: #333; border-bottom: 2px solid #f06292; display: inline-block;">Technical Gadgets</h2>
                <div class="shop__container" style="display: flex; flex-wrap: wrap; justify-content: center;">
                    <xsl:for-each select="/main:unimart/tech:product">
                        <xsl:call-template name="product-card"/>
                    </xsl:for-each>
                </div>
            </div>
        </section>
    </body>
    </html>
</xsl:template>

<xsl:template name="product-card">
    <article class="shop__card" style="background: white; border-radius: 10px; padding: 15px; margin: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align: center; width: 250px;">
        <h3 class="shop__title" style="font-size: 1.1rem; margin-bottom: 10px; height: 50px; overflow: hidden;">
            <xsl:value-of select="book:name | stn:name | tech:name"/>
        </h3>
        <div class="shop__box">
            <img class="shop__img" style="width: 100%; height: 180px; object-fit: contain;">
                <xsl:attribute name="src">
                    <xsl:value-of select="book:image | stn:image | tech:image"/>
                </xsl:attribute>
            </img>
        </div>
        <div class="shop__details" style="margin-top: 10px;">
            <p class="shop__description" style="font-size: 0.9rem; color: #666; height: 40px; overflow: hidden;">
                <xsl:value-of select="book:description | stn:description | tech:description"/>
            </p>
            <div class="shop__price" style="color: #e91e63; font-weight: bold; margin: 10px 0;">
                Rs <xsl:value-of select="book:price | stn:price | tech:price"/>
            </div>
            <button class="btn" style="background-color: #f06292; color: white; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; transition: 0.3s;">
                Add To Cart
            </button>
        </div>
    </article>
</xsl:template>

</xsl:stylesheet>