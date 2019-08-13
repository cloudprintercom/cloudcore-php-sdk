<?php

namespace CloudPrinter\CloudCore\Model;

/**
 * Interface CountryInterface
 *
 * @copyright   2019 by CloudPrinter
 * @author      Vasyl Kushniruk <kushniruk92@gmail.com>
 */
interface CountryInterface
{
    /**
     * Countries that supports states
     */
    const COUNTRIES_WITH_STATES = ['US', 'CA'];

    /**
     * Countries that does not supports zip code.
     */
    const COUNTRIES_WITHOUT_ZIP = [
        'AE', 'AG', 'AO', 'AW', 'BF', 'BI', 'BJ', 'BM', 'BO', 'BQ', 'BS', 'BW', 'BZ', 'CD', 'CF', 'CG', 'CI', 'CK',
        'CM', 'CW', 'DJ', 'DM', 'ER', 'FJ', 'GA', 'GD', 'GH', 'GM', 'GQ', 'GY', 'HK', 'HM', 'IE', 'KI', 'KM', 'KN',
        'KP', 'LY', 'ML', 'MO', 'MR', 'MW', 'NA', 'NR', 'NU', 'PE', 'QA', 'RW', 'SB', 'SC', 'SL', 'SR', 'ST', 'SX',
        'SY', 'TD', 'TF', 'TG', 'TK', 'TL', 'TO', 'TT', 'TV', 'UG', 'VU'
    ];
}
