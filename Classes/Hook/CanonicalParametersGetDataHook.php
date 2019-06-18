<?php

namespace Nemo64\CanonicalUrl\Hook;


use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectGetDataHookInterface;

class CanonicalParametersGetDataHook implements ContentObjectGetDataHookInterface
{
    /**
     * @param string $getDataString Full content of getData-request e.g. "TSFE:id // field:title // field:uid
     * @param array $fields Current field-array
     * @param string $sectionValue Currently examined section value of the getData request e.g. "field:title
     * @param string $returnValue Current returnValue that was processed so far by getData
     * @param \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer $parentObject Parent content object
     *
     * @return string Get data result
     */
    public function getDataExtension($getDataString, $fields, $sectionValue, $returnValue, &$parentObject)
    {
        if ($getDataString !== 'canonical_parameters') {
            return $returnValue;
        }

        // das chash_array enthält alle Parameter aus denen die Checksumme generiert wird.
        // Vorsicht: Auch der encryptionKey ist darin enthalten und muss unbedingt entfernt werden.
        $cHash_array = $GLOBALS['TSFE']->cHash_array;
        unset($cHash_array['encryptionKey']);
        return GeneralUtility::implodeArrayForUrl('', $cHash_array);
    }
}
