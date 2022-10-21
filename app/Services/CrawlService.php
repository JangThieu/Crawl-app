<?php

namespace App\Services;

use Exception;
use App\Models\CountLink;
use FastSimpleHTMLDom\Document;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class CrawlService
{
    public $countLink;

    public function __construct()
    {
        $this->countLink = new CountLink();
    }

    public function mergeTest()
    {
        $fileDate = date('Y-m-d');
        $myfile = fopen(public_path() . '/' . 'dataCrawl/' . $fileDate . '/' . "data.txt", 'r') or die("Unable to open file!");
        $data = fread($myfile, filesize(public_path() . '/' . 'dataCrawl/' . $fileDate . '/' . "data.txt"));

        $filenames = explode(";", $data);
        $filenames = array_slice($filenames, 0, count($filenames) - 1);

        $trimmed_array = array_map('trim', $filenames);
        $fileIndex = 0;
        $arrayTotal = [];
        for ($fileIndex = 0; $fileIndex < count($trimmed_array); $fileIndex++) {
            $arrayTotal = array_merge($arrayTotal,  $this->readDataText($trimmed_array[$fileIndex]));
        }

        $this->exportResult($arrayTotal, true);
    }

    public function crawlData($googleSheet, $megaPrice)
    {
        $MSP = 'Mã sp';
        $MSP2 = 'Mã Sản Phẩm';
        $TEN_HANG = 'Tên hàng';
        $store_SP_One = 'Sp-One';
        $store_XV = 'Xuân Vinh';
        $store_PV = 'Phong Vũ';
        $store_PHILONG = 'Phi Long';
        $store_MEGA = 'MEGA';
        $store_FPT = 'FPT';
        $store_TGDD = 'TGDD';
        $store_XGEAR = 'Xgear';
        $store_AP = 'An Phát';
        $store_HN = 'HÀ NỘI';
        $store_GEARVN = 'Gearvn';
        $store_THNS = 'Tin Học Ngôi Sao';
        $store_PA = 'Phúc Anh';
        $store_AD = 'Anh Đức';
        $store_TZ = 'TopZone';
        $store_HHMB = 'Hoàng Hà Mobile';
        $store_CP = 'CellPhone';
        $store_ZShop = 'ZShop';
        $store_QH = 'Quốc Hùng';
        $store_Viettel = 'Viettel';
        $store_HY = 'Hồng Yến';
        $store_ShopDunk = 'Shopdunk';
        $store_MTMB = 'Minh Tuấn Mobile';
        $store_HG = 'HotGear';
        $store_NC = 'Nguyễn Công';
        $store_TNC = 'TNC';
        $store_AK = 'An Khang';
        $store_NK = 'Nguyễn Kim';
        $store_LTWorld = 'LaptopWorld';
        $store_HCH = 'HangChinhHieu';
        $store_LT88 = 'Laptop88';
        $store_LTAZ = 'LaptopAZ';
        $store_ThinkPro = 'ThinkPro';
        $store_TZones = 'TechZones';
        $store_MMRZones = 'Memory Zone';

        $data = [];

        foreach ($googleSheet as $i => $row) {

            $product = [
                'Sp-One' => 0,
                'Xuân Vinh' => 0,
                'Phong Vũ' => 0,
                'Phi Long' => 0,
                'MEGA' => 0,
                'Xgear' => 0,
                'An Phát' => 0,
                'HÀ NỘI' => 0,
                'Gearvn' => 0,
                'Tin Học Ngôi Sao' => 0,
                'Phúc Anh' => 0,
            ];

            $k = 1;
            foreach ($row as $key => $url) {
                // length row == so link /1 hang
                // increase 9
                $megaPriceStore = 0;
                $priceLowerThanMoreMegaPrice = 0;
                $priceHigherThanMoreMegaPrice = 0;

                if ($MSP == $key || $MSP2 == $key) {
                    $product['MSP'] = $url;
                    if (isset($megaPrice[trim($url)])) {
                        $megaPriceStore = $megaPrice[$url];
                        $product[$store_MEGA] = $megaPriceStore;
                    } else {
                        $product[$store_MEGA] = $megaPriceStore;
                    }
                    // Log::debug('MSP : ' . $url);
                    continue;
                } else if ($TEN_HANG === $key) {
                    $product['ProductName'] = $url;
                    continue;
                } else {
                    $price = 0;
                    if (!empty($url)) { // kiem tra url cos null khong va kiem url cos trong danh sach url error;
                        try {
                            Log::debug('crawl data url : ' . $i . '_' . $k . '_' . $url);
                            $k++;
                            $html = Document::file_get_html($url, false, null, 0);
                            if ($html) {
                                switch (strtoupper($key)) {
                                    case strtoupper($store_SP_One);
                                        $price = $this->getPriceSPOne($html);
                                        break;
                                    case strtoupper($store_XV);
                                        $price = $this->getPriceXV($html);
                                        break;
                                    case strtoupper($store_PV);
                                        $price = $this->getPricePV($html);
                                        break;
                                    case strtoupper($store_PHILONG);
                                        $price = $this->getPricePL($html);
                                        break;
                                    case strtoupper($store_FPT);
                                        $price = $this->getPriceFPT($html);
                                        break;
                                    case strtoupper($store_TGDD);
                                        $price = $this->getPriceTGDD($html);
                                        break;
                                    case strtoupper($store_AP);
                                        $price = $this->getPriceAP($html);
                                        break;
                                    case strtoupper($store_HN);
                                        $price = $this->getPriceHN($html);
                                        break;
                                    case strtoupper($store_GEARVN);
                                        $price = $this->getPriceGearVN($html);
                                        break;
                                    case strtoupper($store_THNS);
                                        $price = $this->getPriceTHNS($url);
                                        break;
                                    case strtoupper($store_PA);
                                        $price = $this->getPricePA($html);
                                        break;
                                    case strtoupper($store_AD);
                                        $price = $this->getPriceAD($html);
                                        break;
                                    case strtoupper($store_TZ);
                                        $price = $this->getPriceTZ($html);
                                        break;
                                    case strtoupper($store_HHMB);
                                        $price = $this->getPriceHHMB($html);
                                        break;
                                    case strtoupper($store_CP);
                                        $price = $this->getPriceCP($url);
                                        break;
                                    case strtoupper($store_ZShop);
                                        $price = $this->getPriceZShop($html);
                                        break;
                                    case strtoupper($store_QH);
                                        $price = $this->getPriceQH($html);
                                        break;
                                    case strtoupper($store_Viettel);
                                        $price = $this->getPriceViettel($html);
                                        break;
                                    case strtoupper($store_HY);
                                        $price = $this->getPriceHY($html);
                                        break;
                                    case strtoupper($store_ShopDunk);
                                        $price = $this->getPriceShopDunk($html);
                                        break;
                                    case strtoupper($store_MTMB);
                                        $price = $this->getPriceMT($html);
                                        break;
                                    case strtoupper($store_HG);
                                        $price = $this->getPriceHG($html);
                                        break;
                                    case strtoupper($store_NC);
                                        $price = $this->getPriceNC($html);
                                        break;
                                    case strtoupper($store_TNC);
                                        $price = $this->getPriceTNC($html);
                                        break;
                                    case strtoupper($store_AK);
                                        $price = $this->getPriceAK($html);
                                        break;
                                    case strtoupper($store_NK);
                                        $price = $this->getPriceNK($html);
                                        break;
                                    case strtoupper($store_LTWorld);
                                        $price = $this->getPriceLTWorld($html);
                                        break;
                                    case strtoupper($store_HCH);
                                        $price = $this->getPriceHCH($html);
                                        break;
                                    case strtoupper($store_LT88);
                                        $price = $this->getPriceLT88($html);
                                        break;
                                    case strtoupper($store_LTAZ);
                                        $price = $this->getPriceLTAZ($html);
                                        break;
                                    case strtoupper($store_ThinkPro);
                                        $price = $this->getPriceThinkPro($html);
                                        break;
                                    case strtoupper($store_TZones);
                                        $price = $this->getPriceTZones($html);
                                        break;
                                    case strtoupper($store_MMRZones);
                                        $price = $this->getPriceMMRZone($html);
                                        break;
                                }
                            }
                        } catch (Exception $e) {
                            continue;
                        }
                    }

                    if (strtoupper($key) !== $store_MEGA) {
                        $product[$key] = $price;
                    }
                    $product['lower'] = '';
                    $product['high'] = '';
                    if ($priceLowerThanMoreMegaPrice === 0) {
                        if ($price < $megaPriceStore) {
                            $product['lower'] = trim($key);
                        }
                    } else {
                        if ($price < $megaPriceStore && $price < $priceLowerThanMoreMegaPrice) {
                            $product['lower'] = trim($key);
                        }
                    }

                    if ($priceHigherThanMoreMegaPrice === 0) {
                        if ($price > $megaPriceStore) {
                            $product['high'] = trim($key);
                        }
                    } else {
                        if ($price > $megaPriceStore && $price < $priceHigherThanMoreMegaPrice) {
                            $product['high'] = trim($key);
                        }
                    }
                    // Log::error("count......");
                    // Log::error(count($googleSheet));
                    $this->countLink->updateTargetLink(1, count($googleSheet) * 315);
                    $this->countLink->updateToltalLink(1, 1); // db = 18

                }
            }



            $data[] = $product;
        }

        $this->exportResult($data, false);
    }

    public function writeDataCSV($errorLinks = [])
    {
        $file = fopen(storage_path() . '/data.csv', "w");
        fputcsv($file, $errorLinks);
        fclose($file);
    }

    public function readDataCsv()
    {
        $linkErrors = [];
        $row = 1;
        if (($handle = fopen(storage_path() . '/data.csv', "r")) !== FALSE) {

            while (($data = fgetcsv($handle)) !== FALSE) {

                $num = count($data);

                $row++;
                for ($c = 0; $c < $num; $c++) {
                    $linkErrors[] = $data[$c];
                }
            }

            fclose($handle);
        }

        return $linkErrors;
    }

    public function readDataText($fileName)
    {
        $fileDate = date('Y-m-d');
        $filePathMega =  public_path() . '/' . 'dataCrawl/' . $fileDate . "/" . $fileName;
        $reader = ReaderEntityFactory::createReaderFromFile($filePathMega);

        $reader->open($filePathMega);
        $data = [];
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $i => $row) {
                ini_set('memory_limit', '-1');
                set_time_limit(0);
                $item = $row->toArray();
                array_push($data, $item);
            }
        }

        $j = 1;
        $dataConvert = [];
        for ($i = 0; $i < count($data) - 1; $i++) {
            $a = $data[0];
            $b = $data[$j];
            $c = array_combine($a, $b);
            $c['MSP'] = $c['Mã sản phẩm'];
            $c['ProductName'] = $c['Tên sản phẩm'];
            $c['high'] = 'Phúc Anh';
            $c = array_slice($c, 2);
            array_push($dataConvert, $c);

            $j++;
        }

        return $dataConvert;
    }

    /**
     * Get price Sp-One from URL handle
     *
     * @return array
     */

    public function getPriceSPOne($html)
    {
        $price = 0;
        foreach ($html->find('div.oneshop-single-product-price') as $e) {
            foreach ($e->find('div.regular-price') as $e2) {
                $price = $e2->find('span', 1);
                $price = str_replace('đ', '', $price->innertext);
                $price = str_replace(".", "", $price);
            }
        }

        return $price;
    }

    /**
     * Get price Xuan-Vinh from URL handle
     *
     * @return array
     */

    public function getPriceXV($html)
    {
        $price = 0;
        foreach ($html->find('div.price-box') as $e) {
            foreach ($e->find('div.special-price') as $e2) {
                $price = $e2->find('span', 0);
                $price = str_replace('₫', '', $price->innertext);
                $price = str_replace(",", "", $price);
            }
        }

        return $price;
    }

    /**
     * Get price Phong-Vu from URL handle
     *
     * @return array
     */

    public function getPricePV($html)
    {
        $price = 0;
        foreach ($html->find('div.css-1q5zfcu') as $e) {
            $price = $e->find('div.css-casirz');
            $price = str_replace('₫', '', $price->text());
            $price = str_replace(".", "", $price);
        }

        return $price;
    }

    /**
     * Get price Phi-Long from URL handle
     *
     * @return array
     */

    public function getPricePL($html)
    {
        $price = 0;
        foreach ($html->find('section.detail-top') as $e) {
            $price = $e->find('span.p-price', 0)->find('span', 1);
            $price = str_replace('Liên hệ', '0', $price->innertext);
            $price = str_replace(".", "", $price);
            $price = str_replace("đ", "", $price);
        }

        return $price;
    }

    public function getPriceFPT($html)
    {
        $price = 0;
        foreach ($html->find('div.st-price__left') as $e) {
            $price = $e->find('div.st-price-main')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
        }

        return $price;
    }

    public function getPriceTGDD($html)
    {
        $price = 0;
        foreach ($html->find('div.box-price') as $e) {
            $price = $e->find('p.box-price-present')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
        }

        return $price;
    }

    /**
     * Get price An-Phat from URL handle
     *
     * @return array
     */

    public function getPriceAP($html)
    {
        $price = 0;
        foreach ($html->find('div.pro_info-price-container') as $e) {
            $price = $e->find('b.js-pro-total-price', 0);
            $price = str_replace('LiÃªn há»', '0', $price->innertext);
            $price = str_replace(".", "", $price);
            $price = str_replace("Ä", "", $price);
        }

        return $price;
    }

    /**
     * Get price Ha-Noi from URL handle
     *
     * @return array
     */

    public function getPriceHN($html)
    {
        $price = 0;
        foreach ($html->find('div#product-info-price') as $e) {
            $price = $e->find('strong#js-pd-price')->text();
            $price = str_replace("₫", "", $price);
            $price = str_replace(".", "", $price);
        }

        return $price;
    }

    /**
     * Get price GEARVN from URL handle
     *
     * @return array
     */

    public function getPriceGearVN($html)
    {
        $price = 0;
        foreach ($html->find('div.product_sales_off') as $e) {
            $price = $e->find('span.product_sale_price', 0);
            $price = str_replace('â«', '0', $price->innertext);
            $price = str_replace("LiÃªn há»", "", $price);
            $price = str_replace(",", "", $price);
        }

        return $price;
    }

    /**
     * Get price THNS from URL handle
     *
     * @return array
     */

    public function getPriceTHNS($url)
    {
        global $price;
        $httpClient = new \Goutte\Client();
        $crawler = $httpClient->request('GET', $url);
        $crawler->filter('.entry-summary .woocommerce-Price-amount')->each(
            function ($node) {
                global $price;
                $price = str_replace("₫", "", $node->text());
                $price = str_replace(",", "", $price);
            }
        );

        return $price;
    }

    /**
     * Get price Phuc-Anh from URL handle
     *
     * @return array
     */

    public function getPricePA($html)
    {
        $price = 0;
        foreach ($html->find('span.detail-product-best-price') as $e) {
            $price = $e->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
            $price = str_replace("â«", "", $price);
        }

        return $price;
    }

    public function getPriceHHMB($html)
    {
        $price = 0;
        foreach ($html->find('div.product-center') as $e) {
            $price = $e->find('p.current-product-price')->find('strong')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
        }
        return $price;
    }

    public function getPriceCP($url)
    {
        $price = 0;
        global $price;
        $httpClient = new \Goutte\Client();
        $crawler = $httpClient->request('GET', $url);
        $crawler->filter('.box-info__box-price> p.product__price--show')->each(
            function ($node) {
                global $price;
                $price = str_replace("₫", "", $node->text());
                $price = str_replace(",", "", $price);
            }
        );

        return $price;
    }

    public function getPriceAD($html)
    {
        $price = 0;
        foreach ($html->find('div.product-price') as $e) {
            $price = $e->find('ins.new-price')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
        }

        return $price;
    }

    public function getPriceTZ($html)
    {
        $price = 0;
        foreach ($html->find('strong.price') as $e) {
            $price = $e->innertext;
            $price = str_replace(".", "", $price);
        }

        return $price;
    }

    public function getPriceZShop($html)
    {
        $price = 0;
        foreach ($html->find('span.ty-price') as $e) {
            $price = $e->find('span.ty-price-num')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("đ", "", $price);
        }

        return $price;
    }

    public function getPriceQH($html)
    {
        $price = 0;
        foreach ($html->find('div.pro-price') as $e) {
            $price = $e->find('span.current-price')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("đ", "", $price);
        }

        return $price;
    }

    public function getPriceViettel($html)
    {
        $price = 0;
        foreach ($html->find('span.color-yellow-orange') as $e) {
            $price = $e->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("đ", "", $price);
        }

        return $price;
    }

    public function getPriceHY($html)
    {
        $price = 0;
        foreach ($html->find('div.price-prod') as $e) {
            $price = $e->find('span')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("vnđ", "", $price);
        }

        return $price;
    }

    public function getPriceShopDunk($html)
    {
        $price = 0;
        foreach ($html->find('p.price') as $e) {
            $price = $e->find('span.woocommerce-Price-amount')->find('bdi')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
        }

        return $price;
    }

    public function getPriceMT($html)
    {
        $price = 0;
        foreach ($html->find('div.prodetail_pricebox_main') as $e) {
            $price = $e->find('p.prodetail__price')->find('span.price')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("VNĐ", "", $price);
        }

        return $price;
    }

    public function getPriceHG($html)
    {
        $price = 0;
        foreach ($html->find('div.product_sales_off') as $e) {
            $price = $e->find('span.product_sale_price')->text();
            $price = str_replace(",", "", $price);
            $price = str_replace("₫", "", $price);
        }
        return $price;
    }

    public function getPriceNC($html)
    {
        $price = 0;
        foreach ($html->find('div.detail-price') as $e) {
            $price = $e->find('span.price')->text();
            $price = str_replace(".", "", $price);
            $price = str_replace("Ä", "", $price);
        }

        return $price;
    }

    public function getPriceTNC($html)
    {
        $price = 0;
        foreach ($html->find('ul.list-price') as $e) {
            $price = $e->find('p.price')->text();
            $price = str_replace(".", "", $price);
            $price = str_replace("đ", "", $price);
        }

        return $price;
    }

    public function getPriceAK($html)
    {
        $price = 0;
        foreach ($html->find('table.pd-table-2021') as $e) {
            $price = $e->find('span.pro-price')->text();
            $price = str_replace(".", "", $price);
            $price = str_replace("VNĐ", "", $price);
        }

        return $price;
    }

    public function getPriceNK($html)
    {
        $price = 0;
        foreach ($html->find('div.product_info_price_value-final') as $e) {
            $price = $e->find('span.nk-price-final')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("Ä", "", $price);
        }

        return $price;
    }

    public function getPriceLTWorld($html)
    {
        $price = 0;
        foreach ($html->find('span.p-price-full ') as $e) {
            $price = $e->find('span.price-border')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("đ", "", $price);
        }

        return $price;
    }

    public function getPriceHCH($html)
    {
        $price = 0;
        foreach ($html->find('div.product-price') as $e) {
            $price = $e->find('span.pro-price')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
        }

        return $price;
    }

    public function getPriceLTAZ($html)
    {
        $price = 0;
        foreach ($html->find('span.js-price-config') as $e) {
            $price = $e->find('span.show-him')->innertext;
            $price = str_replace(".", "", $price);
        }

        return $price;
    }

    public function getPriceThinkPro($html)
    {
        $price = 0;
        foreach ($html->find('span.font-extrabold') as $e) {
            $price = $e->innertext;
            $price = str_replace(".", "", $price);
        }

        return $price;
    }

    public function getPriceTZones($html)
    {
        $price = 0;
        foreach ($html->find('section.product-info') as $e) {
            $price = $e->find('div.product-price')->find('div.price-option')->text();
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
            $price = str_replace("Giá: Liên hệ", "", $price);
        }

        return $price;
    }

    public function getPriceLT88($html)
    {
        $price = 0;
        foreach ($html->find('div.main-product-mid') as $e) {
            $price = $e->find('div.js-price-config')->innertext;
            $price = str_replace(".", "", $price);
            $price = str_replace("Đ", "", $price);
        }

        return $price;
    }

    public function getPriceMMRZone($html)
    {
        $price = 0;
        foreach ($html->find('span.special-price') as $e) {
            $price = $e->find('span.product-price')->text();
            $price = str_replace(".", "", $price);
            $price = str_replace("₫", "", $price);
            $price = str_replace("Liên hệ", "", $price);
        }

        return $price;
    }

    // get range columns
    public function getColumnsRange($start = 'A', $end = 'ZZ')
    {
        $return_range = [];
        for ($i = $start; $i !== $end; $i++) {
            $return_range[] = $i;
        }

        return $return_range;
    }

    public function createFile()
    {
        $fileDate = date('Y-m-d');
        $path = public_path() . '/' . 'dataCrawl/' . $fileDate;
        while (is_dir($path)) {
            return;
        }
        mkdir($path, 0777, true);
        while (!is_dir($path . '/' . 'data.txt')) {
            $myfile = fopen($path . '/' . "data.txt", "w") or die("Unable to open file!");
            fwrite($myfile, '');
            return;
        }
        return true;
    }

    public function exportResult($data = [], $writeFile = false)
    {

        if (File::exists(public_path() . '/storage/data.xlsx')) {
        }
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $columnName = $this->getColumnsRange();

        $columnNumber = 0;
        $rowNumber = 1;
        $isColorChangeArr = [];
        foreach ($data as $index => $item) {

            $indexRow = $index + 2;
            if ($index === 0) {
                $sheet->setCellValue('A1', 'Mã sản phẩm');
                $sheet->setCellValue('B1', 'Tên sản phẩm');

                $j = 2;
                foreach ($item as $key => $value) {

                    if ($key == 'high' || $key == 'lower') {
                        continue;
                    }
                    if ($key !== 'MSP' && $key !== 'ProductName') {
                        $sheet->setCellValue($columnName[$j] . 1, $key);
                        $j++;
                    }
                }

                $columnNumber = count($item) - 2;
            }

            $k = 2;
            $dataHandleSecond = [];

            $isChangeColor = 'A';
            foreach ($item as $key => $value) {

                if ($key == 'high' || $key == 'lower') {
                    continue;
                }
                if ($key == 'MSP') {
                    $sheet->setCellValue('A' . $indexRow, $value);
                } else if ($key == 'ProductName') {
                    $sheet->setCellValue('B' . $indexRow, $value);
                } else {
                    $sheet->setCellValue($columnName[$k] . $indexRow, $value == 0 ? 'x' : $value);
                    array_push($dataHandleSecond, $value);
                    $k++;
                }
            }

            $dataMap = array_map(function ($items) {
                if (empty($items)) {
                    return 0;
                }
                return $items;
            }, $dataHandleSecond);

            $megaColor = $dataMap[4];

            $filterData = array_filter($dataMap, function ($item) {
                return $item > 0 && $item !== 'x';
            });

            if (empty($filterData)) {
                global $isChangeColor;
                $isChangeColor = 'C';
            } else if ($megaColor !== min($filterData) && $megaColor !== 'x' &&  !empty($megaColor)) {
                global $isChangeColor;
                $isChangeColor = 'B';
            } else if (($megaColor === min($filterData) && count($filterData) === 1) || $megaColor === 'x' || empty($megaColor)) {
                global $isChangeColor;
                $isChangeColor = 'C';
            } else {
                global $isChangeColor;
                $isChangeColor = 'A';
            }

            array_push($isColorChangeArr, $isChangeColor);
            $rowNumber++;
        }

        // Set width column
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(14);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(54);
        $columsDefault = array_filter($columnName, function ($column) {
            return $column !== 'A' && $column !== 'B';
        });

        foreach ($columsDefault as $letra) {
            $spreadsheet->getActiveSheet()->getColumnDimension($letra)->setWidth(15);
        }

        for ($r = 1; $r <= $indexRow; $r++) {
            if ($r == 1) {
                $headerr = $spreadsheet->getActiveSheet()->getStyle('A1:' . $columnName[$columnNumber - 1] . '1');
                $headerr->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('1a73e8');
                $headerr->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $headerr->getFont()->setBold(true);
            } else {
                for ($column = 0; $column < $columnNumber; $column++) {
                    // set border
                    $nodeIndex = $spreadsheet->getActiveSheet()->getStyle($columnName[$column] . $r);

                    $nodeIndex->getBorders()->getBottom()->setBorderStyle(Border::BORDER_DOTTED);
                    $nodeIndex->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);

                    // set text background color
                    $node = $spreadsheet->getActiveSheet()->getStyle($columnName[$column] . $r . ':' .  $columnName[$column] . $indexRow);
                    $noteARGB = $node->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor();

                    if ($column == 0) {
                        $noteARGB->setARGB('d9d9d9');
                        $nodeIndex->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
                    } else if ($column == 1) {
                        $noteARGB->setARGB('eedfec');
                        $nodeIndex->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setWrapText(true);
                    } else if ($column == 6) {
                        if ($writeFile) {
                            echo ($r);
                        }

                        switch ($isColorChangeArr[$r - 2]) {
                            case 'A':
                                $noteARGB->setARGB('ff0000');
                                $nodeIndex->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                                break;
                            case 'B':
                                $noteARGB->setARGB('ffff00');
                                $nodeIndex->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                                break;
                            case 'C':
                                $noteARGB->setARGB('fde9d9');
                                $nodeIndex->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                                break;
                        }
                    } else {
                        $noteARGB->setARGB('fde9d9');
                        // set text style
                        $nodeIndex->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                    }
                    $nodeIndex->getAlignment()->setVertical(Alignment::HORIZONTAL_CENTER)->setWrapText(true);
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        $fileDate = date('Y-m-d');
        $path = public_path() . '/' . 'dataCrawl/' . $fileDate;
        if (!file_exists($path)) {
            $this->createFile();
        }

        if ($writeFile) {
            $fileName = public_path() . '/dataCrawl' . "/" . $fileDate . '/data';
            $saveFilePath = explode('/', $fileName);
            $myfile = fopen(public_path() . '/' . "dataCrawl" . "/" . $fileDate . "/" . "data", "a") or die("Unable to open file!");
            $txt = $saveFilePath[3] . '.xlsx' . ";\n";
            fwrite($myfile, $txt);
            $writer->save($fileName . '.xlsx');
            fclose($myfile);
        }

        $fileName = public_path() . '/dataCrawl' . "/" . $fileDate . '/data_' . strtotime(date('Y/m/d h:m:s'));
        $saveFilePath = explode('/', $fileName);
        $writer->save($fileName . '.xlsx');
        $myfile = fopen(public_path() . '/' . "dataCrawl" . "/" . $fileDate . "/" . "data.txt", "a") or die("Unable to open file!");
        $txt = $saveFilePath[3] . '.xlsx' . ";\n";
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}
