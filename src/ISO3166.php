<?php

/*
 * (c) Rob Bast <rob.bast@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace League\ISO3166;

use League\ISO3166\Exception\DomainException;
use League\ISO3166\Exception\OutOfBoundsException;

final class ISO3166 implements \Countable, \IteratorAggregate, ISO3166DataProvider
{
    /** @var string */
    const KEY_ALPHA2 = 'alpha2';
    /** @var string */
    const KEY_ALPHA3 = 'alpha3';
    /** @var string */
    const KEY_NUMERIC = 'numeric';
    /** @var string */
    const KEY_NAME = 'name';
    /** @var string[] */
    private $keys = [self::KEY_ALPHA2, self::KEY_ALPHA3, self::KEY_NUMERIC, self::KEY_NAME];

    /**
     * @param array[] $countries replace default dataset with given array
     */
    public function __construct(array $countries = [])
    {
        if ($countries) {
            $this->countries = $countries;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function name($name)
    {
        Guards::guardAgainstInvalidName($name);

        return $this->lookup(self::KEY_NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function alpha2($alpha2)
    {
        Guards::guardAgainstInvalidAlpha2($alpha2);

        return $this->lookup(self::KEY_ALPHA2, $alpha2);
    }

    /**
     * {@inheritdoc}
     */
    public function alpha3($alpha3)
    {
        Guards::guardAgainstInvalidAlpha3($alpha3);

        return $this->lookup(self::KEY_ALPHA3, $alpha3);
    }

    /**
     * {@inheritdoc}
     */
    public function numeric($numeric)
    {
        Guards::guardAgainstInvalidNumeric($numeric);

        return $this->lookup(self::KEY_NUMERIC, $numeric);
    }

    /**
     * @return array[]
     */
    public function all()
    {
        return $this->countries;
    }

    /**
     * @param string $key
     *
     * @throws \League\ISO3166\Exception\DomainException if an invalid key is specified
     *
     * @return \Generator
     */
    public function iterator($key = self::KEY_ALPHA2)
    {
        if (! in_array($key, $this->keys, true)) {
            throw new DomainException(sprintf(
                'Invalid value for $indexBy, got "%s", expected one of: %s',
                $key,
                implode(', ', $this->keys)
            ));
        }

        foreach ($this->countries as $country) {
            yield $country[$key] => $country;
        }
    }

    /**
     * @see \Countable
     *
     * @internal
     *
     * @return int
     */
    public function count()
    {
        return count($this->countries);
    }

    /**
     * @see \IteratorAggregate
     *
     * @internal
     *
     * @return \Generator
     */
    public function getIterator()
    {
        foreach ($this->countries as $country) {
            yield $country;
        }
    }

    /**
     * Lookup ISO3166-1 data by given identifier.
     *
     * Looks for a match against the given key for each entry in the dataset.
     *
     * @param string $key
     * @param string $value
     *
     * @throws \League\ISO3166\Exception\OutOfBoundsException if key does not exist in dataset
     *
     * @return array
     */
    private function lookup($key, $value)
    {
        foreach ($this->countries as $country) {
            if (strcasecmp($value, $country[$key]) === 0) {
                return $country;
            }
        }

        throw new OutOfBoundsException(
            sprintf('No "%s" key found matching: %s', $key, $value)
        );
    }

    /**
    * Default dataset.
    *
    * @var array[]
    */
    private $countries = [
        [
            "name" => "Afghanistan",
            "alpha2" => "AF",
            "alpha3" => "AFG",
            "numeric" => "004",
            "currency" => [
                "AFN",
            ],
        ],
        [
            "name" => "Åland",
            "alpha2" => "AX",
            "alpha3" => "ALA",
            "numeric" => "248",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Albanien",
            "alpha2" => "AL",
            "alpha3" => "ALB",
            "numeric" => "008",
            "currency" => [
                "ALL",
            ],
        ],
        [
            "name" => "Algeriet",
            "alpha2" => "DZ",
            "alpha3" => "DZA",
            "numeric" => "012",
            "currency" => [
                "DZD",
            ],
        ],
        [
            "name" => "Amerikanska Samoa",
            "alpha2" => "AS",
            "alpha3" => "ASM",
            "numeric" => "016",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Andorra",
            "alpha2" => "AD",
            "alpha3" => "AND",
            "numeric" => "020",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Angola",
            "alpha2" => "AO",
            "alpha3" => "AGO",
            "numeric" => "024",
            "currency" => [
                "AOA",
            ],
        ],
        [
            "name" => "Anguilla",
            "alpha2" => "AI",
            "alpha3" => "AIA",
            "numeric" => "660",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Antarktis",
            "alpha2" => "AQ",
            "alpha3" => "ATA",
            "numeric" => "010",
            "currency" => [
                "ARS",
                "AUD",
                "BGN",
                "BRL",
                "BYR",
                "CLP",
                "CNY",
                "CZK",
                "EUR",
                "GBP",
                "INR",
                "JPY",
                "KRW",
                "NOK",
                "NZD",
                "PEN",
                "PKR",
                "PLN",
                "RON",
                "RUB",
                "SEK",
                "UAH",
                "USD",
                "UYU",
                "ZAR",
            ],
        ],
        [
            "name" => "Antigua och Barbuda",
            "alpha2" => "AG",
            "alpha3" => "ATG",
            "numeric" => "028",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Argentina",
            "alpha2" => "AR",
            "alpha3" => "ARG",
            "numeric" => "032",
            "currency" => [
                "ARS",
            ],
        ],
        [
            "name" => "Armenien",
            "alpha2" => "AM",
            "alpha3" => "ARM",
            "numeric" => "051",
            "currency" => [
                "AMD",
            ],
        ],
        [
            "name" => "Aruba",
            "alpha2" => "AW",
            "alpha3" => "ABW",
            "numeric" => "533",
            "currency" => [
                "AWG",
            ],
        ],
        [
            "name" => "Australien",
            "alpha2" => "AU",
            "alpha3" => "AUS",
            "numeric" => "036",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Österrike",
            "alpha2" => "AT",
            "alpha3" => "AUT",
            "numeric" => "040",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Azerbajdzjan",
            "alpha2" => "AZ",
            "alpha3" => "AZE",
            "numeric" => "031",
            "currency" => [
                "AZN",
            ],
        ],
        [
            "name" => "Bahamas",
            "alpha2" => "BS",
            "alpha3" => "BHS",
            "numeric" => "044",
            "currency" => [
                "BSD",
            ],
        ],
        [
            "name" => "Bahrain",
            "alpha2" => "BH",
            "alpha3" => "BHR",
            "numeric" => "048",
            "currency" => [
                "BHD",
            ],
        ],
        [
            "name" => "Bangladesh",
            "alpha2" => "BD",
            "alpha3" => "BGD",
            "numeric" => "050",
            "currency" => [
                "BDT",
            ],
        ],
        [
            "name" => "Barbados",
            "alpha2" => "BB",
            "alpha3" => "BRB",
            "numeric" => "052",
            "currency" => [
                "BBD",
            ],
        ],
        [
            "name" => "Vitryssland",
            "alpha2" => "BY",
            "alpha3" => "BLR",
            "numeric" => "112",
            "currency" => [
                "BYN",
            ],
        ],
        [
            "name" => "Belgien",
            "alpha2" => "BE",
            "alpha3" => "BEL",
            "numeric" => "056",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Belize",
            "alpha2" => "BZ",
            "alpha3" => "BLZ",
            "numeric" => "084",
            "currency" => [
                "BZD",
            ],
        ],
        [
            "name" => "Benin",
            "alpha2" => "BJ",
            "alpha3" => "BEN",
            "numeric" => "204",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Bermuda",
            "alpha2" => "BM",
            "alpha3" => "BMU",
            "numeric" => "060",
            "currency" => [
                "BMD",
            ],
        ],
        [
            "name" => "Bhutan",
            "alpha2" => "BT",
            "alpha3" => "BTN",
            "numeric" => "064",
            "currency" => [
                "BTN",
            ],
        ],
        [
            "name" => "Bolivia",
            "alpha2" => "BO",
            "alpha3" => "BOL",
            "numeric" => "068",
            "currency" => [
                "BOB",
            ],
        ],
        [
            "name" => "Karibiska Nederländerna",
            "alpha2" => "BQ",
            "alpha3" => "BES",
            "numeric" => "535",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Bosnien och Hercegovina",
            "alpha2" => "BA",
            "alpha3" => "BIH",
            "numeric" => "070",
            "currency" => [
                "BAM",
            ],
        ],
        [
            "name" => "Botswana",
            "alpha2" => "BW",
            "alpha3" => "BWA",
            "numeric" => "072",
            "currency" => [
                "BWP",
            ],
        ],
        [
            "name" => "Bouvetön",
            "alpha2" => "BV",
            "alpha3" => "BVT",
            "numeric" => "074",
            "currency" => [
                "NOK",
            ],
        ],
        [
            "name" => "Brasilien",
            "alpha2" => "BR",
            "alpha3" => "BRA",
            "numeric" => "076",
            "currency" => [
                "BRL",
            ],
        ],
        [
            "name" => "Brittiska territoriet i Indiska oceanen",
            "alpha2" => "IO",
            "alpha3" => "IOT",
            "numeric" => "086",
            "currency" => [
                "GBP",
            ],
        ],
        [
            "name" => "Brunei",
            "alpha2" => "BN",
            "alpha3" => "BRN",
            "numeric" => "096",
            "currency" => [
                "BND",
                "SGD",
            ],
        ],
        [
            "name" => "Bulgarien",
            "alpha2" => "BG",
            "alpha3" => "BGR",
            "numeric" => "100",
            "currency" => [
                "BGN",
            ],
        ],
        [
            "name" => "Burkina Faso",
            "alpha2" => "BF",
            "alpha3" => "BFA",
            "numeric" => "854",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Burundi",
            "alpha2" => "BI",
            "alpha3" => "BDI",
            "numeric" => "108",
            "currency" => [
                "BIF",
            ],
        ],
        [
            "name" => "Kap Verde",
            "alpha2" => "CV",
            "alpha3" => "CPV",
            "numeric" => "132",
            "currency" => [
                "CVE",
            ],
        ],
        [
            "name" => "Kambodja",
            "alpha2" => "KH",
            "alpha3" => "KHM",
            "numeric" => "116",
            "currency" => [
                "KHR",
            ],
        ],
        [
            "name" => "Kamerun",
            "alpha2" => "CM",
            "alpha3" => "CMR",
            "numeric" => "120",
            "currency" => [
                "XAF",
            ],
        ],
        [
            "name" => "Kanada",
            "alpha2" => "CA",
            "alpha3" => "CAN",
            "numeric" => "124",
            "currency" => [
                "CAD",
            ],
        ],
        [
            "name" => "Caymanöarna",
            "alpha2" => "KY",
            "alpha3" => "CYM",
            "numeric" => "136",
            "currency" => [
                "KYD",
            ],
        ],
        [
            "name" => "Centralafrikanska republiken",
            "alpha2" => "CF",
            "alpha3" => "CAF",
            "numeric" => "140",
            "currency" => [
                "XAF",
            ],
        ],
        [
            "name" => "Tchad",
            "alpha2" => "TD",
            "alpha3" => "TCD",
            "numeric" => "148",
            "currency" => [
                "XAF",
            ],
        ],
        [
            "name" => "Chile",
            "alpha2" => "CL",
            "alpha3" => "CHL",
            "numeric" => "152",
            "currency" => [
                "CLP",
            ],
        ],
        [
            "name" => "Kina",
            "alpha2" => "CN",
            "alpha3" => "CHN",
            "numeric" => "156",
            "currency" => [
                "CNY",
            ],
        ],
        [
            "name" => "Julön",
            "alpha2" => "CX",
            "alpha3" => "CXR",
            "numeric" => "162",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Kokosöarna",
            "alpha2" => "CC",
            "alpha3" => "CCK",
            "numeric" => "166",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Colombia",
            "alpha2" => "CO",
            "alpha3" => "COL",
            "numeric" => "170",
            "currency" => [
                "COP",
            ],
        ],
        [
            "name" => "Komorerna",
            "alpha2" => "KM",
            "alpha3" => "COM",
            "numeric" => "174",
            "currency" => [
                "KMF",
            ],
        ],
        [
            "name" => "Kongo-Brazzaville",
            "alpha2" => "CG",
            "alpha3" => "COG",
            "numeric" => "178",
            "currency" => [
                "XAF",
            ],
        ],
        [
            "name" => "Kongo-Kinshasa",
            "alpha2" => "CD",
            "alpha3" => "COD",
            "numeric" => "180",
            "currency" => [
                "CDF",
            ],
        ],
        [
            "name" => "Cooköarna",
            "alpha2" => "CK",
            "alpha3" => "COK",
            "numeric" => "184",
            "currency" => [
                "NZD",
            ],
        ],
        [
            "name" => "Costa Rica",
            "alpha2" => "CR",
            "alpha3" => "CRI",
            "numeric" => "188",
            "currency" => [
                "CRC",
            ],
        ],
        [
            "name" => "Elfenbenskusten",
            "alpha2" => "CI",
            "alpha3" => "CIV",
            "numeric" => "384",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Kroatien",
            "alpha2" => "HR",
            "alpha3" => "HRV",
            "numeric" => "191",
            "currency" => [
                "HRK",
            ],
        ],
        [
            "name" => "Kuba",
            "alpha2" => "CU",
            "alpha3" => "CUB",
            "numeric" => "192",
            "currency" => [
                "CUC",
                "CUP",
            ],
        ],
        [
            "name" => "Curaçao",
            "alpha2" => "CW",
            "alpha3" => "CUW",
            "numeric" => "531",
            "currency" => [
                "ANG",
            ],
        ],
        [
            "name" => "Cypern",
            "alpha2" => "CY",
            "alpha3" => "CYP",
            "numeric" => "196",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Tjeckien",
            "alpha2" => "CZ",
            "alpha3" => "CZE",
            "numeric" => "203",
            "currency" => [
                "CZK",
            ],
        ],
        [
            "name" => "Danmark",
            "alpha2" => "DK",
            "alpha3" => "DNK",
            "numeric" => "208",
            "currency" => [
                "DKK",
            ],
        ],
        [
            "name" => "Djibouti",
            "alpha2" => "DJ",
            "alpha3" => "DJI",
            "numeric" => "262",
            "currency" => [
                "DJF",
            ],
        ],
        [
            "name" => "Dominica",
            "alpha2" => "DM",
            "alpha3" => "DMA",
            "numeric" => "212",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Dominikanska republiken",
            "alpha2" => "DO",
            "alpha3" => "DOM",
            "numeric" => "214",
            "currency" => [
                "DOP",
            ],
        ],
        [
            "name" => "Ecuador",
            "alpha2" => "EC",
            "alpha3" => "ECU",
            "numeric" => "218",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Egypten",
            "alpha2" => "EG",
            "alpha3" => "EGY",
            "numeric" => "818",
            "currency" => [
                "EGP",
            ],
        ],
        [
            "name" => "El Salvador",
            "alpha2" => "SV",
            "alpha3" => "SLV",
            "numeric" => "222",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Ekvatorialguinea",
            "alpha2" => "GQ",
            "alpha3" => "GNQ",
            "numeric" => "226",
            "currency" => [
                "XAF",
            ],
        ],
        [
            "name" => "Eritrea",
            "alpha2" => "ER",
            "alpha3" => "ERI",
            "numeric" => "232",
            "currency" => [
                "ERN",
            ],
        ],
        [
            "name" => "Estland",
            "alpha2" => "EE",
            "alpha3" => "EST",
            "numeric" => "233",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Etiopien",
            "alpha2" => "ET",
            "alpha3" => "ETH",
            "numeric" => "231",
            "currency" => [
                "ETB",
            ],
        ],
        [
            "name" => "Swaziland",
            "alpha2" => "SZ",
            "alpha3" => "SWZ",
            "numeric" => "748",
            "currency" => [
                "SZL",
                "ZAR",
            ],
        ],
        [
            "name" => "Falklandsöarna",
            "alpha2" => "FK",
            "alpha3" => "FLK",
            "numeric" => "238",
            "currency" => [
                "FKP",
            ],
        ],
        [
            "name" => "Färöarna",
            "alpha2" => "FO",
            "alpha3" => "FRO",
            "numeric" => "234",
            "currency" => [
                "DKK",
            ],
        ],
        [
            "name" => "Fiji",
            "alpha2" => "FJ",
            "alpha3" => "FJI",
            "numeric" => "242",
            "currency" => [
                "FJD",
            ],
        ],
        [
            "name" => "Finland",
            "alpha2" => "FI",
            "alpha3" => "FIN",
            "numeric" => "246",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Frankrike",
            "alpha2" => "FR",
            "alpha3" => "FRA",
            "numeric" => "250",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Franska Guyana",
            "alpha2" => "GF",
            "alpha3" => "GUF",
            "numeric" => "254",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Franska Polynesien",
            "alpha2" => "PF",
            "alpha3" => "PYF",
            "numeric" => "258",
            "currency" => [
                "XPF",
            ],
        ],
        [
            "name" => "Franska sydterritorierna",
            "alpha2" => "TF",
            "alpha3" => "ATF",
            "numeric" => "260",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Gabon",
            "alpha2" => "GA",
            "alpha3" => "GAB",
            "numeric" => "266",
            "currency" => [
                "XAF",
            ],
        ],
        [
            "name" => "Gambia",
            "alpha2" => "GM",
            "alpha3" => "GMB",
            "numeric" => "270",
            "currency" => [
                "GMD",
            ],
        ],
        [
            "name" => "Georgien",
            "alpha2" => "GE",
            "alpha3" => "GEO",
            "numeric" => "268",
            "currency" => [
                "GEL",
            ],
        ],
        [
            "name" => "Tyskland",
            "alpha2" => "DE",
            "alpha3" => "DEU",
            "numeric" => "276",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Ghana",
            "alpha2" => "GH",
            "alpha3" => "GHA",
            "numeric" => "288",
            "currency" => [
                "GHS",
            ],
        ],
        [
            "name" => "Gibraltar",
            "alpha2" => "GI",
            "alpha3" => "GIB",
            "numeric" => "292",
            "currency" => [
                "GIP",
            ],
        ],
        [
            "name" => "Grekland",
            "alpha2" => "GR",
            "alpha3" => "GRC",
            "numeric" => "300",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Grönland",
            "alpha2" => "GL",
            "alpha3" => "GRL",
            "numeric" => "304",
            "currency" => [
                "DKK",
            ],
        ],
        [
            "name" => "Grenada",
            "alpha2" => "GD",
            "alpha3" => "GRD",
            "numeric" => "308",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Guadeloupe",
            "alpha2" => "GP",
            "alpha3" => "GLP",
            "numeric" => "312",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Guam",
            "alpha2" => "GU",
            "alpha3" => "GUM",
            "numeric" => "316",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Guatemala",
            "alpha2" => "GT",
            "alpha3" => "GTM",
            "numeric" => "320",
            "currency" => [
                "GTQ",
            ],
        ],
        [
            "name" => "Guernsey",
            "alpha2" => "GG",
            "alpha3" => "GGY",
            "numeric" => "831",
            "currency" => [
                "GBP",
            ],
        ],
        [
            "name" => "Guinea",
            "alpha2" => "GN",
            "alpha3" => "GIN",
            "numeric" => "324",
            "currency" => [
                "GNF",
            ],
        ],
        [
            "name" => "Guinea-Bissau",
            "alpha2" => "GW",
            "alpha3" => "GNB",
            "numeric" => "624",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Guyana",
            "alpha2" => "GY",
            "alpha3" => "GUY",
            "numeric" => "328",
            "currency" => [
                "GYD",
            ],
        ],
        [
            "name" => "Haiti",
            "alpha2" => "HT",
            "alpha3" => "HTI",
            "numeric" => "332",
            "currency" => [
                "HTG",
            ],
        ],
        [
            "name" => "Heard- och McDonaldöarna",
            "alpha2" => "HM",
            "alpha3" => "HMD",
            "numeric" => "334",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Vatikanstaten",
            "alpha2" => "VA",
            "alpha3" => "VAT",
            "numeric" => "336",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Honduras",
            "alpha2" => "HN",
            "alpha3" => "HND",
            "numeric" => "340",
            "currency" => [
                "HNL",
            ],
        ],
        [
            "name" => "Hongkong",
            "alpha2" => "HK",
            "alpha3" => "HKG",
            "numeric" => "344",
            "currency" => [
                "HKD",
            ],
        ],
        [
            "name" => "Ungern",
            "alpha2" => "HU",
            "alpha3" => "HUN",
            "numeric" => "348",
            "currency" => [
                "HUF",
            ],
        ],
        [
            "name" => "Island",
            "alpha2" => "IS",
            "alpha3" => "ISL",
            "numeric" => "352",
            "currency" => [
                "ISK",
            ],
        ],
        [
            "name" => "Indien",
            "alpha2" => "IN",
            "alpha3" => "IND",
            "numeric" => "356",
            "currency" => [
                "INR",
            ],
        ],
        [
            "name" => "Indonesien",
            "alpha2" => "ID",
            "alpha3" => "IDN",
            "numeric" => "360",
            "currency" => [
                "IDR",
            ],
        ],
        [
            "name" => "Iran",
            "alpha2" => "IR",
            "alpha3" => "IRN",
            "numeric" => "364",
            "currency" => [
                "IRR",
            ],
        ],
        [
            "name" => "Irak",
            "alpha2" => "IQ",
            "alpha3" => "IRQ",
            "numeric" => "368",
            "currency" => [
                "IQD",
            ],
        ],
        [
            "name" => "Irland",
            "alpha2" => "IE",
            "alpha3" => "IRL",
            "numeric" => "372",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Isle of Man",
            "alpha2" => "IM",
            "alpha3" => "IMN",
            "numeric" => "833",
            "currency" => [
                "GBP",
            ],
        ],
        [
            "name" => "Israel",
            "alpha2" => "IL",
            "alpha3" => "ISR",
            "numeric" => "376",
            "currency" => [
                "ILS",
            ],
        ],
        [
            "name" => "Italien",
            "alpha2" => "IT",
            "alpha3" => "ITA",
            "numeric" => "380",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Jamaica",
            "alpha2" => "JM",
            "alpha3" => "JAM",
            "numeric" => "388",
            "currency" => [
                "JMD",
            ],
        ],
        [
            "name" => "Japan",
            "alpha2" => "JP",
            "alpha3" => "JPN",
            "numeric" => "392",
            "currency" => [
                "JPY",
            ],
        ],
        [
            "name" => "Jersey",
            "alpha2" => "JE",
            "alpha3" => "JEY",
            "numeric" => "832",
            "currency" => [
                "GBP",
            ],
        ],
        [
            "name" => "Jordanien",
            "alpha2" => "JO",
            "alpha3" => "JOR",
            "numeric" => "400",
            "currency" => [
                "JOD",
            ],
        ],
        [
            "name" => "Kazakstan",
            "alpha2" => "KZ",
            "alpha3" => "KAZ",
            "numeric" => "398",
            "currency" => [
                "KZT",
            ],
        ],
        [
            "name" => "Kenya",
            "alpha2" => "KE",
            "alpha3" => "KEN",
            "numeric" => "404",
            "currency" => [
                "KES",
            ],
        ],
        [
            "name" => "Kiribati",
            "alpha2" => "KI",
            "alpha3" => "KIR",
            "numeric" => "296",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Nordkorea",
            "alpha2" => "KP",
            "alpha3" => "PRK",
            "numeric" => "408",
            "currency" => [
                "KPW",
            ],
        ],
        [
            "name" => "Sydkorea",
            "alpha2" => "KR",
            "alpha3" => "KOR",
            "numeric" => "410",
            "currency" => [
                "KRW",
            ],
        ],
        [
            "name" => "Kuwait",
            "alpha2" => "KW",
            "alpha3" => "KWT",
            "numeric" => "414",
            "currency" => [
                "KWD",
            ],
        ],
        [
            "name" => "Kirgizistan",
            "alpha2" => "KG",
            "alpha3" => "KGZ",
            "numeric" => "417",
            "currency" => [
                "KGS",
            ],
        ],
        [
            "name" => "Laos",
            "alpha2" => "LA",
            "alpha3" => "LAO",
            "numeric" => "418",
            "currency" => [
                "LAK",
            ],
        ],
        [
            "name" => "Lettland",
            "alpha2" => "LV",
            "alpha3" => "LVA",
            "numeric" => "428",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Libanon",
            "alpha2" => "LB",
            "alpha3" => "LBN",
            "numeric" => "422",
            "currency" => [
                "LBP",
            ],
        ],
        [
            "name" => "Lesotho",
            "alpha2" => "LS",
            "alpha3" => "LSO",
            "numeric" => "426",
            "currency" => [
                "LSL",
                "ZAR",
            ],
        ],
        [
            "name" => "Liberia",
            "alpha2" => "LR",
            "alpha3" => "LBR",
            "numeric" => "430",
            "currency" => [
                "LRD",
            ],
        ],
        [
            "name" => "Libyen",
            "alpha2" => "LY",
            "alpha3" => "LBY",
            "numeric" => "434",
            "currency" => [
                "LYD",
            ],
        ],
        [
            "name" => "Liechtenstein",
            "alpha2" => "LI",
            "alpha3" => "LIE",
            "numeric" => "438",
            "currency" => [
                "CHF",
            ],
        ],
        [
            "name" => "Litauen",
            "alpha2" => "LT",
            "alpha3" => "LTU",
            "numeric" => "440",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Luxemburg",
            "alpha2" => "LU",
            "alpha3" => "LUX",
            "numeric" => "442",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Macao",
            "alpha2" => "MO",
            "alpha3" => "MAC",
            "numeric" => "446",
            "currency" => [
                "MOP",
            ],
        ],
        [
            "name" => "Nordmakedonien",
            "alpha2" => "MK",
            "alpha3" => "MKD",
            "numeric" => "807",
            "currency" => [
                "MKD",
            ],
        ],
        [
            "name" => "Madagaskar",
            "alpha2" => "MG",
            "alpha3" => "MDG",
            "numeric" => "450",
            "currency" => [
                "MGA",
            ],
        ],
        [
            "name" => "Malawi",
            "alpha2" => "MW",
            "alpha3" => "MWI",
            "numeric" => "454",
            "currency" => [
                "MWK",
            ],
        ],
        [
            "name" => "Malaysia",
            "alpha2" => "MY",
            "alpha3" => "MYS",
            "numeric" => "458",
            "currency" => [
                "MYR",
            ],
        ],
        [
            "name" => "Maldiverna",
            "alpha2" => "MV",
            "alpha3" => "MDV",
            "numeric" => "462",
            "currency" => [
                "MVR",
            ],
        ],
        [
            "name" => "Mali",
            "alpha2" => "ML",
            "alpha3" => "MLI",
            "numeric" => "466",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Malta",
            "alpha2" => "MT",
            "alpha3" => "MLT",
            "numeric" => "470",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Marshallöarna",
            "alpha2" => "MH",
            "alpha3" => "MHL",
            "numeric" => "584",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Martinique",
            "alpha2" => "MQ",
            "alpha3" => "MTQ",
            "numeric" => "474",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Mauretanien",
            "alpha2" => "MR",
            "alpha3" => "MRT",
            "numeric" => "478",
            "currency" => [
                "MRO",
            ],
        ],
        [
            "name" => "Mauritius",
            "alpha2" => "MU",
            "alpha3" => "MUS",
            "numeric" => "480",
            "currency" => [
                "MUR",
            ],
        ],
        [
            "name" => "Mayotte",
            "alpha2" => "YT",
            "alpha3" => "MYT",
            "numeric" => "175",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Mexiko",
            "alpha2" => "MX",
            "alpha3" => "MEX",
            "numeric" => "484",
            "currency" => [
                "MXN",
            ],
        ],
        [
            "name" => "Mikronesien",
            "alpha2" => "FM",
            "alpha3" => "FSM",
            "numeric" => "583",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Moldavien",
            "alpha2" => "MD",
            "alpha3" => "MDA",
            "numeric" => "498",
            "currency" => [
                "MDL",
            ],
        ],
        [
            "name" => "Monaco",
            "alpha2" => "MC",
            "alpha3" => "MCO",
            "numeric" => "492",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Mongoliet",
            "alpha2" => "MN",
            "alpha3" => "MNG",
            "numeric" => "496",
            "currency" => [
                "MNT",
            ],
        ],
        [
            "name" => "Montenegro",
            "alpha2" => "ME",
            "alpha3" => "MNE",
            "numeric" => "499",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Montserrat",
            "alpha2" => "MS",
            "alpha3" => "MSR",
            "numeric" => "500",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Marocko",
            "alpha2" => "MA",
            "alpha3" => "MAR",
            "numeric" => "504",
            "currency" => [
                "MAD",
            ],
        ],
        [
            "name" => "Moçambique",
            "alpha2" => "MZ",
            "alpha3" => "MOZ",
            "numeric" => "508",
            "currency" => [
                "MZN",
            ],
        ],
        [
            "name" => "Myanmar (Burma)",
            "alpha2" => "MM",
            "alpha3" => "MMR",
            "numeric" => "104",
            "currency" => [
                "MMK",
            ],
        ],
        [
            "name" => "Namibia",
            "alpha2" => "NA",
            "alpha3" => "NAM",
            "numeric" => "516",
            "currency" => [
                "NAD",
                "ZAR",
            ],
        ],
        [
            "name" => "Nauru",
            "alpha2" => "NR",
            "alpha3" => "NRU",
            "numeric" => "520",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Nepal",
            "alpha2" => "NP",
            "alpha3" => "NPL",
            "numeric" => "524",
            "currency" => [
                "NPR",
            ],
        ],
        [
            "name" => "Nederländerna",
            "alpha2" => "NL",
            "alpha3" => "NLD",
            "numeric" => "528",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Nya Kaledonien",
            "alpha2" => "NC",
            "alpha3" => "NCL",
            "numeric" => "540",
            "currency" => [
                "XPF",
            ],
        ],
        [
            "name" => "Nya Zeeland",
            "alpha2" => "NZ",
            "alpha3" => "NZL",
            "numeric" => "554",
            "currency" => [
                "NZD",
            ],
        ],
        [
            "name" => "Nicaragua",
            "alpha2" => "NI",
            "alpha3" => "NIC",
            "numeric" => "558",
            "currency" => [
                "NIO",
            ],
        ],
        [
            "name" => "Niger",
            "alpha2" => "NE",
            "alpha3" => "NER",
            "numeric" => "562",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Nigeria",
            "alpha2" => "NG",
            "alpha3" => "NGA",
            "numeric" => "566",
            "currency" => [
                "NGN",
            ],
        ],
        [
            "name" => "Niue",
            "alpha2" => "NU",
            "alpha3" => "NIU",
            "numeric" => "570",
            "currency" => [
                "NZD",
            ],
        ],
        [
            "name" => "Norfolkön",
            "alpha2" => "NF",
            "alpha3" => "NFK",
            "numeric" => "574",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Nordmarianerna",
            "alpha2" => "MP",
            "alpha3" => "MNP",
            "numeric" => "580",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Norge",
            "alpha2" => "NO",
            "alpha3" => "NOR",
            "numeric" => "578",
            "currency" => [
                "NOK",
            ],
        ],
        [
            "name" => "Oman",
            "alpha2" => "OM",
            "alpha3" => "OMN",
            "numeric" => "512",
            "currency" => [
                "OMR",
            ],
        ],
        [
            "name" => "Pakistan",
            "alpha2" => "PK",
            "alpha3" => "PAK",
            "numeric" => "586",
            "currency" => [
                "PKR",
            ],
        ],
        [
            "name" => "Palau",
            "alpha2" => "PW",
            "alpha3" => "PLW",
            "numeric" => "585",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Palestinska territorierna",
            "alpha2" => "PS",
            "alpha3" => "PSE",
            "numeric" => "275",
            "currency" => [
                "ILS",
            ],
        ],
        [
            "name" => "Panama",
            "alpha2" => "PA",
            "alpha3" => "PAN",
            "numeric" => "591",
            "currency" => [
                "PAB",
            ],
        ],
        [
            "name" => "Papua Nya Guinea",
            "alpha2" => "PG",
            "alpha3" => "PNG",
            "numeric" => "598",
            "currency" => [
                "PGK",
            ],
        ],
        [
            "name" => "Paraguay",
            "alpha2" => "PY",
            "alpha3" => "PRY",
            "numeric" => "600",
            "currency" => [
                "PYG",
            ],
        ],
        [
            "name" => "Peru",
            "alpha2" => "PE",
            "alpha3" => "PER",
            "numeric" => "604",
            "currency" => [
                "PEN",
            ],
        ],
        [
            "name" => "Filippinerna",
            "alpha2" => "PH",
            "alpha3" => "PHL",
            "numeric" => "608",
            "currency" => [
                "PHP",
            ],
        ],
        [
            "name" => "Pitcairnöarna",
            "alpha2" => "PN",
            "alpha3" => "PCN",
            "numeric" => "612",
            "currency" => [
                "NZD",
            ],
        ],
        [
            "name" => "Polen",
            "alpha2" => "PL",
            "alpha3" => "POL",
            "numeric" => "616",
            "currency" => [
                "PLN",
            ],
        ],
        [
            "name" => "Portugal",
            "alpha2" => "PT",
            "alpha3" => "PRT",
            "numeric" => "620",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Puerto Rico",
            "alpha2" => "PR",
            "alpha3" => "PRI",
            "numeric" => "630",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Qatar",
            "alpha2" => "QA",
            "alpha3" => "QAT",
            "numeric" => "634",
            "currency" => [
                "QAR",
            ],
        ],
        [
            "name" => "Réunion",
            "alpha2" => "RE",
            "alpha3" => "REU",
            "numeric" => "638",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Rumänien",
            "alpha2" => "RO",
            "alpha3" => "ROU",
            "numeric" => "642",
            "currency" => [
                "RON",
            ],
        ],
        [
            "name" => "Ryssland",
            "alpha2" => "RU",
            "alpha3" => "RUS",
            "numeric" => "643",
            "currency" => [
                "RUB",
            ],
        ],
        [
            "name" => "Rwanda",
            "alpha2" => "RW",
            "alpha3" => "RWA",
            "numeric" => "646",
            "currency" => [
                "RWF",
            ],
        ],
        [
            "name" => "S:t Barthélemy",
            "alpha2" => "BL",
            "alpha3" => "BLM",
            "numeric" => "652",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "S:t Helena",
            "alpha2" => "SH",
            "alpha3" => "SHN",
            "numeric" => "654",
            "currency" => [
                "SHP",
            ],
        ],
        [
            "name" => "S:t Kitts och Nevis",
            "alpha2" => "KN",
            "alpha3" => "KNA",
            "numeric" => "659",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "S:t Lucia",
            "alpha2" => "LC",
            "alpha3" => "LCA",
            "numeric" => "662",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Saint-Martin",
            "alpha2" => "MF",
            "alpha3" => "MAF",
            "numeric" => "663",
            "currency" => [
                "EUR",
                "USD",
            ],
        ],
        [
            "name" => "S:t Pierre och Miquelon",
            "alpha2" => "PM",
            "alpha3" => "SPM",
            "numeric" => "666",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "S:t Vincent och Grenadinerna",
            "alpha2" => "VC",
            "alpha3" => "VCT",
            "numeric" => "670",
            "currency" => [
                "XCD",
            ],
        ],
        [
            "name" => "Samoa",
            "alpha2" => "WS",
            "alpha3" => "WSM",
            "numeric" => "882",
            "currency" => [
                "WST",
            ],
        ],
        [
            "name" => "San Marino",
            "alpha2" => "SM",
            "alpha3" => "SMR",
            "numeric" => "674",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "São Tomé och Príncipe",
            "alpha2" => "ST",
            "alpha3" => "STP",
            "numeric" => "678",
            "currency" => [
                "STD",
            ],
        ],
        [
            "name" => "Saudiarabien",
            "alpha2" => "SA",
            "alpha3" => "SAU",
            "numeric" => "682",
            "currency" => [
                "SAR",
            ],
        ],
        [
            "name" => "Senegal",
            "alpha2" => "SN",
            "alpha3" => "SEN",
            "numeric" => "686",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Serbien",
            "alpha2" => "RS",
            "alpha3" => "SRB",
            "numeric" => "688",
            "currency" => [
                "RSD",
            ],
        ],
        [
            "name" => "Seychellerna",
            "alpha2" => "SC",
            "alpha3" => "SYC",
            "numeric" => "690",
            "currency" => [
                "SCR",
            ],
        ],
        [
            "name" => "Sierra Leone",
            "alpha2" => "SL",
            "alpha3" => "SLE",
            "numeric" => "694",
            "currency" => [
                "SLL",
            ],
        ],
        [
            "name" => "Singapore",
            "alpha2" => "SG",
            "alpha3" => "SGP",
            "numeric" => "702",
            "currency" => [
                "SGD",
            ],
        ],
        [
            "name" => "Sint Maarten",
            "alpha2" => "SX",
            "alpha3" => "SXM",
            "numeric" => "534",
            "currency" => [
                "ANG",
            ],
        ],
        [
            "name" => "Slovakien",
            "alpha2" => "SK",
            "alpha3" => "SVK",
            "numeric" => "703",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Slovenien",
            "alpha2" => "SI",
            "alpha3" => "SVN",
            "numeric" => "705",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Salomonöarna",
            "alpha2" => "SB",
            "alpha3" => "SLB",
            "numeric" => "090",
            "currency" => [
                "SBD",
            ],
        ],
        [
            "name" => "Somalia",
            "alpha2" => "SO",
            "alpha3" => "SOM",
            "numeric" => "706",
            "currency" => [
                "SOS",
            ],
        ],
        [
            "name" => "Sydafrika",
            "alpha2" => "ZA",
            "alpha3" => "ZAF",
            "numeric" => "710",
            "currency" => [
                "ZAR",
            ],
        ],
        [
            "name" => "Sydgeorgien och Sydsandwichöarna",
            "alpha2" => "GS",
            "alpha3" => "SGS",
            "numeric" => "239",
            "currency" => [
                "GBP",
            ],
        ],
        [
            "name" => "Sydsudan",
            "alpha2" => "SS",
            "alpha3" => "SSD",
            "numeric" => "728",
            "currency" => [
                "SSP",
            ],
        ],
        [
            "name" => "Spanien",
            "alpha2" => "ES",
            "alpha3" => "ESP",
            "numeric" => "724",
            "currency" => [
                "EUR",
            ],
        ],
        [
            "name" => "Sri Lanka",
            "alpha2" => "LK",
            "alpha3" => "LKA",
            "numeric" => "144",
            "currency" => [
                "LKR",
            ],
        ],
        [
            "name" => "Sudan",
            "alpha2" => "SD",
            "alpha3" => "SDN",
            "numeric" => "729",
            "currency" => [
                "SDG",
            ],
        ],
        [
            "name" => "Surinam",
            "alpha2" => "SR",
            "alpha3" => "SUR",
            "numeric" => "740",
            "currency" => [
                "SRD",
            ],
        ],
        [
            "name" => "Svalbard och Jan Mayen",
            "alpha2" => "SJ",
            "alpha3" => "SJM",
            "numeric" => "744",
            "currency" => [
                "NOK",
            ],
        ],
        [
            "name" => "Sverige",
            "alpha2" => "SE",
            "alpha3" => "SWE",
            "numeric" => "752",
            "currency" => [
                "SEK",
            ],
        ],
        [
            "name" => "Schweiz",
            "alpha2" => "CH",
            "alpha3" => "CHE",
            "numeric" => "756",
            "currency" => [
                "CHF",
            ],
        ],
        [
            "name" => "Syrien",
            "alpha2" => "SY",
            "alpha3" => "SYR",
            "numeric" => "760",
            "currency" => [
                "SYP",
            ],
        ],
        [
            "name" => "Taiwan",
            "alpha2" => "TW",
            "alpha3" => "TWN",
            "numeric" => "158",
            "currency" => [
                "TWD",
            ],
        ],
        [
            "name" => "Tadzjikistan",
            "alpha2" => "TJ",
            "alpha3" => "TJK",
            "numeric" => "762",
            "currency" => [
                "TJS",
            ],
        ],
        [
            "name" => "Tanzania",
            "alpha2" => "TZ",
            "alpha3" => "TZA",
            "numeric" => "834",
            "currency" => [
                "TZS",
            ],
        ],
        [
            "name" => "Thailand",
            "alpha2" => "TH",
            "alpha3" => "THA",
            "numeric" => "764",
            "currency" => [
                "THB",
            ],
        ],
        [
            "name" => "Östtimor",
            "alpha2" => "TL",
            "alpha3" => "TLS",
            "numeric" => "626",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Togo",
            "alpha2" => "TG",
            "alpha3" => "TGO",
            "numeric" => "768",
            "currency" => [
                "XOF",
            ],
        ],
        [
            "name" => "Tokelau",
            "alpha2" => "TK",
            "alpha3" => "TKL",
            "numeric" => "772",
            "currency" => [
                "NZD",
            ],
        ],
        [
            "name" => "Tonga",
            "alpha2" => "TO",
            "alpha3" => "TON",
            "numeric" => "776",
            "currency" => [
                "TOP",
            ],
        ],
        [
            "name" => "Trinidad och Tobago",
            "alpha2" => "TT",
            "alpha3" => "TTO",
            "numeric" => "780",
            "currency" => [
                "TTD",
            ],
        ],
        [
            "name" => "Tunisien",
            "alpha2" => "TN",
            "alpha3" => "TUN",
            "numeric" => "788",
            "currency" => [
                "TND",
            ],
        ],
        [
            "name" => "Turkiet",
            "alpha2" => "TR",
            "alpha3" => "TUR",
            "numeric" => "792",
            "currency" => [
                "TRY",
            ],
        ],
        [
            "name" => "Turkmenistan",
            "alpha2" => "TM",
            "alpha3" => "TKM",
            "numeric" => "795",
            "currency" => [
                "TMT",
            ],
        ],
        [
            "name" => "Turks- och Caicosöarna",
            "alpha2" => "TC",
            "alpha3" => "TCA",
            "numeric" => "796",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Tuvalu",
            "alpha2" => "TV",
            "alpha3" => "TUV",
            "numeric" => "798",
            "currency" => [
                "AUD",
            ],
        ],
        [
            "name" => "Uganda",
            "alpha2" => "UG",
            "alpha3" => "UGA",
            "numeric" => "800",
            "currency" => [
                "UGX",
            ],
        ],
        [
            "name" => "Ukraina",
            "alpha2" => "UA",
            "alpha3" => "UKR",
            "numeric" => "804",
            "currency" => [
                "UAH",
            ],
        ],
        [
            "name" => "Förenade Arabemiraten",
            "alpha2" => "AE",
            "alpha3" => "ARE",
            "numeric" => "784",
            "currency" => [
                "AED",
            ],
        ],
        [
            "name" => "Storbritannien",
            "alpha2" => "GB",
            "alpha3" => "GBR",
            "numeric" => "826",
            "currency" => [
                "GBP",
            ],
        ],
        [
            "name" => "USA",
            "alpha2" => "US",
            "alpha3" => "USA",
            "numeric" => "840",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "USA:s yttre öar",
            "alpha2" => "UM",
            "alpha3" => "UMI",
            "numeric" => "581",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Uruguay",
            "alpha2" => "UY",
            "alpha3" => "URY",
            "numeric" => "858",
            "currency" => [
                "UYU",
            ],
        ],
        [
            "name" => "Uzbekistan",
            "alpha2" => "UZ",
            "alpha3" => "UZB",
            "numeric" => "860",
            "currency" => [
                "UZS",
            ],
        ],
        [
            "name" => "Vanuatu",
            "alpha2" => "VU",
            "alpha3" => "VUT",
            "numeric" => "548",
            "currency" => [
                "VUV",
            ],
        ],
        [
            "name" => "Venezuela",
            "alpha2" => "VE",
            "alpha3" => "VEN",
            "numeric" => "862",
            "currency" => [
                "VEF",
            ],
        ],
        [
            "name" => "Vietnam",
            "alpha2" => "VN",
            "alpha3" => "VNM",
            "numeric" => "704",
            "currency" => [
                "VND",
            ],
        ],
        [
            "name" => "Brittiska Jungfruöarna",
            "alpha2" => "VG",
            "alpha3" => "VGB",
            "numeric" => "092",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Amerikanska Jungfruöarna",
            "alpha2" => "VI",
            "alpha3" => "VIR",
            "numeric" => "850",
            "currency" => [
                "USD",
            ],
        ],
        [
            "name" => "Wallis- och Futunaöarna",
            "alpha2" => "WF",
            "alpha3" => "WLF",
            "numeric" => "876",
            "currency" => [
                "XPF",
            ],
        ],
        [
            "name" => "Västsahara",
            "alpha2" => "EH",
            "alpha3" => "ESH",
            "numeric" => "732",
            "currency" => [
                "MAD",
            ],
        ],
        [
            "name" => "Jemen",
            "alpha2" => "YE",
            "alpha3" => "YEM",
            "numeric" => "887",
            "currency" => [
                "YER",
            ],
        ],
        [
            "name" => "Zambia",
            "alpha2" => "ZM",
            "alpha3" => "ZMB",
            "numeric" => "894",
            "currency" => [
                "ZMW",
            ],
        ],
        [
            "name" => "Zimbabwe",
            "alpha2" => "ZW",
            "alpha3" => "ZWE",
            "numeric" => "716",
            "currency" => [
                "BWP",
                "EUR",
                "GBP",
                "USD",
                "ZAR",
            ],
        ],
    ];
}
