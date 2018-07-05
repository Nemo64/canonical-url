# EXT:canonical_url

This extension adds some canonical url features to your page.

This extension is based on my [Blog Post] (in german) in which you can read more about the topic of canonical urls in typo3 and why they aren't as simple as they should be.

There are also a lot of extension that already bring canonical support with varying implementation quality but in those the canonical url is just one of many features.

This extension only focuses on how to handle the current page url and you can install this extension and just use the typoscript extensions without any page modifications if you want to have full control.

## Main features

### Static TypoScript Template for `<link rel="canonical">`

This extensions adds a TypoScript for you to use. Just add the fittingly named `<link rel="canonical"> (canonical_url)` static include to your typoscript template and you are all set.

## TypoScript extensions

### `data = canonical_parameters`

You can use the new [getText] funktion `canonical_parameters` to get the query string to the current page. This is different to addQueryString in that it only includes parameters that are relevant for the cache and therefor validated using the [cHash Mechanismus].

```
lib.link = TEXT
lib.link.value = Current page
lib.link.typolink {
    parameter.data = page:uid
    additionalParams.data = canonical_parameters
    useCacheHash = 1
}
```

[Blog Post]: https://www.marco.zone/typo3-canonical-url
[getText]: https://docs.typo3.org/typo3cms/TyposcriptReference/8.7/DataTypes/Gettext/
[cHash Mechanismus]: https://www.typo3lexikon.de/typo3-tutorials/core/cache/chash-was-ist-das.html
