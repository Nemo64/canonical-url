[![Latest Stable Version](https://poser.pugx.org/nemo64/canonical-url/v/stable)](https://packagist.org/packages/nemo64/canonical-url)
[![Total Downloads](https://poser.pugx.org/nemo64/canonical-url/downloads)](https://packagist.org/packages/nemo64/canonical-url)
[![License](https://poser.pugx.org/nemo64/canonical-url/license)](https://packagist.org/packages/nemo64/canonical-url)

# EXT:canonical_url

This extension adds some canonical url features to your page.

This extension is based on my [Blog Post] (in german) in which you can read more about the topic of canonical urls in typo3 and why they aren't as simple as they should be.

There are also a lot of extension that already bring canonical support with varying implementation quality but in those the canonical url is just one of many features.

This extension only focuses on how to handle the current page url and you can install this extension and just use the typoscript extensions without any page modifications if you want to have full control.

I encourage you to use this extension as a dependency in your extension if you need canonical_parameters. This extension won't do anything except for providing the canonical_parameters getText function (and later maybe more ways like view helpers). The integrator will always have to include the static typoscript for this extension to have any effect. It is therefor a save dependency.

## Main features

### Static TypoScript template for `<link rel="canonical">`

This extensions adds a TypoScript for you to use. Just add the fittingly named `<link rel="canonical"> (canonical_url)` static include to your typoscript template and you are all set.

### TypoScript extension `data = canonical_parameters`

You can use the new [getText] funktion `canonical_parameters` to get the query string to the current page. This is different to addQueryString in that it only includes parameters that are relevant for the cache and therefor validated using the [cHash Mechanismus].

Here an example on how to create a link to the current page:

```php
lib.currentPageLink = TEXT
lib.currentPageLink {
    value = Current page
    
    typolink {
        parameter.data = page:uid
        additionalParams.data = canonical_parameters
        useCacheHash = 1
    }
}
```

And here an example on how to create a breadcrumb where the last entry is the current page:

```php
lib.breadcrumb = HMENU
lib.breadcrumb {
    wrap = <nav aria-label="breadcrumb"><ol class="breadcrumb">|</ol></nav>
    special = rootline
    special.range = 1|-1
    includeNotInMenu = 1
    
    1 = TMENU
    1 {
        NO = 1
        NO.wrapItemAndSub = <li class="breadcrumb-item">|</li>
        
        CUR < .NO
        CUR.additionalParams.data = canonical_parameters
        CUR.wrapItemAndSub = <li class="breadcrumb-item active" aria-current="page">|</li>
        CUR.stdWrap.data = TSFE:altPageTitle // page:nav_title // page:title
        CUR.doNotLinkIt = 1
    }
}
```

And here an example on how to implement hreflang:

```php
page.headerData {
    99 = TEXT
    99.wrap = <link rel="alternate" hreflang="x-default" href="|">
    99.typolink {
        parameter.data = page:uid
        additionalParams.data = canonical_parameters
        additionalParams.wrap = |&L=0
    }
    
    100 < .99
    100.wrap = <link rel="alternate" hreflang="en" href="|">
    100.typolink.additionalParams.wrap = |&L=0
    
    101 < .99
    101.wrap = <link rel="alternate" hreflang="de" href="|">
    101.typolink.additionalParams.wrap = |&L=1
}
```

[Blog Post]: https://www.marco.zone/typo3-canonical-url
[getText]: https://docs.typo3.org/typo3cms/TyposcriptReference/8.7/DataTypes/Gettext/
[cHash Mechanismus]: https://www.typo3lexikon.de/typo3-tutorials/core/cache/chash-was-ist-das.html
