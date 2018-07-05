# EXT:canonical_url

This extension adds some canonical url features to your page.

## base features

### `<link rel="canonical">`

This extensions adds a TypoScript for you to use. Just add the fittingly named `<link rel="canonical"> (canonical_url)` static include to your typoscript template and you are all set.

## TypoScript extensions

### `data = canonical_parameters`

You can use the new [getText] funktion `canonical_parameters` to get the query string to the current page. This is different to addQueryString in that it only includes parameters that are relevant for the cache and therefor validated using the [cHash Mechanismus].

```
page.headerData.1530780685 = TEXT
page.headerData.1530780685 {
    wrap = <link rel="canonical" href="|">
    typolink.parameter.data = page:uid
    typolink.returnLast = url
    typolink.forceAbsoluteUrl = 1

    typolink.additionalParams.data = canonical_parameters
    typolink.useCacheHash = 1
}
```

[getText]: https://docs.typo3.org/typo3cms/TyposcriptReference/8.7/DataTypes/Gettext/
[cHash Mechanismus]: https://www.typo3lexikon.de/typo3-tutorials/core/cache/chash-was-ist-das.html