<?
/* Structure of MIRRORS array:
  0	"country code",
  1	"Mirror Name",
  2	flag for whether local stats work (1) or not (0) on this mirror
  3	"url for hosting company",
  4	flag for whether site is a full mirror (1) or just a download site (0), or just a placeholder (2),
  5	flag for whether search engine works (1) or not (0) on the site
  6 default language code
*/

$MIRRORS = array(
  'http://gtk.php.net/'			=> array('us', 'VA Linux', 0, 'http://www.valinux.com/', 1, 0, 'en' ),
  'http://gtk.php.easydns.ca/'		=> array('ca', 'easyDNS Technologies', 0, 'http://www.easydns.com/', 1, 0, 'en' )
);

$COUNTRIES = array(
   'au' => 'Australia',
   'at' => 'Austria',
   'be' => 'Belgium',
   'bg' => 'Bulgaria',
   'br' => 'Brazil',
   'ca' => 'Canada',
   'ch' => 'Switzerland',
   'cl' => 'Chile',
   'cn' => 'China',
   'cz' => 'Czech Republic',
   'de' => 'Germany',
   'dk' => 'Denmark',
   'ee' => 'Estonia',
   'es' => 'Spain',
   'fi' => 'Finland',
   'fr' => 'France',
   'gr' => 'Greece',
   'hk' => 'China (Hong Kong)',
   'hu' => 'Hungary',
   'id' => 'Indonesia',
   'ie' => 'Ireland',
   'il' => 'Israel',
   'it' => 'Italy',
   'jp' => 'Japan',
   'kr' => 'Korea',
   'lv' => 'Latvia',
   'mx' => 'Mexico',
   'nl' => 'Netherlands',
   'no' => 'Norway',
   'nz' => 'New Zealand',
   'ph' => 'Philippines',
   'pl' => 'Poland',
   'pt' => 'Portugal',
   'ro' => 'Romania',
   'ru' => 'Russian Federation',
   'se' => 'Sweden',
   'sk' => 'Slovakia',
   'sg' => 'Singapore',
   'th' => 'Thailand',
   'tr' => 'Turkey',
   'tw' => 'Taiwan',
   'ua' => 'Ukraine',
   'uk' => 'United Kingdom',
   'us' => 'United States',
   'za' => 'South Africa',
   'xx' => 'Other'
);

# http://www.unicode.org/unicode/onlinedat/languages.html
$LANGUAGES = array(
    'en' => 'English',
    'pt_BR' => 'Brazilian Portuguese',
    'bg' => 'Bulgarian',
    'ca' => 'Catalan',
    'zh' => 'Chinese',
    'cs' => 'Czech',
    'da' => 'Danish',
    'nl' => 'Dutch',
    'fi' => 'Finnish',
    'fr' => 'French',
    'de' => 'German',
    'el' => 'Greek',
    'hu' => 'Hungarian',
    'it' => 'Italian',
    'ja' => 'Japanese',
    'kr' => 'Korean', # this should be 'ko'. its wrong in phpdoc.
    'lv' => 'Latvian',
    'no' => 'Norwegian',
    'pl' => 'Polish',
    'pt' => 'Portuguese',
    'ro' => 'Romanian',
    'ru' => 'Russian',
    'sk' => 'Slovak',
    'es' => 'Spanish',
    'sv' => 'Swedish',
    'th' => 'Thai',
    'tr' => 'Turkish',
    'uk' => 'Ukranian',
);

$MYSITE = 'http://' . getenv('SERVER_NAME') . '/'; 

if (!isset($MIRRORS[$MYSITE])) {
    $MYSITE='http://' . preg_replace('/^www\./', '', $HTTP_HOST) . '/';
}
if (!isset($MIRRORS[$MYSITE])) {
    $MIRRORS[$MYSITE] = array('xx', $MYSITE, 'none', $MYSITE, 2, 0, 'en');
}

echo "<!-- $MYSITE -->";

?>
